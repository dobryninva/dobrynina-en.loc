// функционал для работы виджетов на странице товара
// отслеживаем изменение количества и опций на странице товара, чтобы в виджет попадали актуальные данные
const modal_widget = document.getElementById('eShopLogisticWidgetModal'),
    block_widget = document.getElementById('eShopLogisticWidgetBlock')
let widget = null,
    widgetType = null,
    widgetReady = false

// проверка JSON
function isJSON(str) {
    try {
        return JSON.parse(str)
    } catch (e) {
        return false
    }
}

if(modal_widget || block_widget) {

    if(modal_widget) {
        widget = modal_widget
        widgetType = 'modal'
    } else {
        widget = block_widget
        widgetType = 'block'
    }

    let offers_json = widget.dataset.offers

    if(typeof offers_json !== 'undefined') {

        if(offers = isJSON(offers_json)) {

            widgetReady = true

            if (typeof offers[0].count !== 'undefined') {
                const count = document.querySelector('.ms2_form input[name="count"]')
                if (count) {
                    count.onchange = function () {
                        offers[0].count = this.value
                        widget.dataset.offers = JSON.stringify(offers)
                    }
                }
            }

            document.addEventListener('change', function (event) {
                const attr_name = event.target.name
                let option_prepared = attr_name.match(/options\[(.*?)\]/)
                if (option_prepared) {
                    if (typeof option_prepared[1] === 'string') {
                        if (typeof offers[0].options[option_prepared[1]] !== 'undefined') {
                            offers[0].options[option_prepared[1]].value = event.target.value
                            widget.dataset.offers = JSON.stringify(offers)
                        }
                    }
                }

                if(widgetType === 'block') {
                    widget.dispatchEvent(new CustomEvent('eShopLogisticWidgetBlock:updateParamsRequest', {
                        detail: {
                            requestParams: {
                                offers: JSON.stringify(offers)
                            }
                        }
                    }))
                }

            })
        }
    }

    if(!widgetReady) {
        console.log('Виджет не может быть запущен. Проверьте правильность указания data-offers.')
    }
}


// функционал для работы виджета в корзине

// объект модальной формы для выбора населённого пункта
let modalSearchForm = {
    elements: {
        modal: null
    },
    init: function () {

        if (this.elements.modal === null) {
            modalSearchForm.create()
        }

        const _self = this

        window.onclick = function (event) {
            if (event.target == _self.elements.modal) {
                _self.elements.modal.style.display = 'none'
            }
        }

        const closeModalElement = document.querySelector('#eShopLogisticModal .close')
        closeModalElement.onclick = function () {
            _self.elements.modal.style.display = 'none'
        }

        document.querySelector('#eShopLogisticSearch').oninput = function() {
            if(this.value.length >= 3) {
                eShopLogistic.selectSettlement(this.value)
            }
        }

        document.addEventListener("click", function(event){
            if(typeof event.target.dataset['fias'] !== 'undefined') {
                if (event.target.closest('#eShopLogisticSearchResult')) {

                    _self.elements.modal.style.display = 'none'

                    eShopLogistic.items.delivery.disabled = false

                    eShopLogistic.params.settlement = {
                        "name": event.target.dataset['name'],
                        "region": event.target.dataset['region'],
                        "fias": event.target.dataset['fias'],
                        "services": event.target.dataset['services']
                    }

                    eShopLogistic.setSettlementRegion()
                }
            }
        })

    },
    create: function () {
        const html = '<div class="modal_container">\n' +
                '<div class="modal_header">\n' +
                '   Выберите населённый пункт\n' +
                '   <span class="close">×</span>\n' +
                '</div>\n' +
                '<div class="modal_content">\n' +
                '   <div class="form-floating"><input type="text" id="eShopLogisticSearch" class="form-control"><label for="eShopLogisticSearch">Поиск по названию</label></div>\n' +
                '   <hr>\n' +
                '   <div id="eShopLogisticSearchResult"></div>\n' +
                '   </div>\n' +
                '</div>',
            //container = document.getElementById('msOrder')
            container = document.body

        let modal = document.createElement('div')
        modal.setAttribute('id', 'eShopLogisticModal')
        modal.innerHTML = html
        container.append(modal)
        this.elements.modal = modal
    },
    setData: function (data) {
        if(typeof data === 'object') {
            const contentBlock = document.getElementById('eShopLogisticSearchResult')
            if (contentBlock) {
                let content = ''
                for (const k in data) {
                    content += '<div class="delivery-region"><p>'+k+'</p><ul>'
                    data[k].forEach(element => {
                        content += '<li>' +
                            '<a class="rank-'+element.rank+'" ' +
                            'role="button" data-name="'+element.type+' '+element.name+'" data-region="'+element.region+'" data-fias="'+element.fias+'" ' +
                            'data-services='+JSON.stringify(element.services)+'>'+element.name+' <span>'+element.type+'</span></a>' +
                            '</li>'
                    })
                    content += '</ul></div>'
                }
                contentBlock.innerHTML = content
            }
        }
    }
}

// объект для работы с виджетом
let eShopLogistic = {
    stateLoad: false,
    items: {
        widget: null,
        delivery: null,
        settlement: null,
        region: null,
        payments: null,
        infoBlock: null,
        defaultDelivery: null
    },
    params: {
        offers: null,
        payment: null,
        settlement: null
    },
    init: function () {

        const _self = this

        if(typeof eshoplogistic3Config.delivery_id === 'number') {
            const delivery = document.getElementById('delivery_'+eshoplogistic3Config.delivery_id)
            if(delivery) {
                this.items.delivery = delivery
            } else {
                console.log('Ошибка: на странице отсутствует вариант доставки id="delivery_'+eshoplogistic3Config.delivery_id+'"')
                return
            }
        } else {
            console.log('Ошибка: в настройках MS2 не включён вариант доставки eShopLogistic')
            return
        }

        if(eshoplogistic3Config.default_delivery_id !== 0) {
            const defaultDelivery = document.getElementById('delivery_'+eshoplogistic3Config.default_delivery_id)
            if(defaultDelivery) {
                this.items.defaultDelivery = defaultDelivery
            } else {
                console.log('Ошибка: на странице отсутствует вариант доставки по умолчанию id="delivery_'+eshoplogistic3Config.default_delivery_id+'"')
                return
            }
        } else {
            console.log('Ошибка: в настройках eshoplogistic3 не включён вариант доставки по умолчанию')
        }

        this.items.infoBlock = document.getElementById('eShopLogistic3Info')
        this.items.widget = document.getElementById('eShopLogisticWidgetCart')
        this.items.payments = JSON.parse(eshoplogistic3Config.payments)
        this.items.settlement = document.getElementById('city')

        if(this.items.settlement) {
            this.items.settlement.readOnly = true
            this.items.settlement.addEventListener('click', event => {
                modalSearchForm.elements.modal.style.display = 'block'
            })
        } else {
            console.log('Ошибка: на странице отсутствует поле выбора населённого пункта id="city"')
            return
        }

        const region = document.getElementById('region')
        if(region) {
            this.items.region = region
            this.items.region.readOnly = true
            this.items.region.addEventListener('click', event => {
                modalSearchForm.elements.modal.style.display = 'block'
            })
        }

        let params = 'action=geo'
        if(typeof this.items.widget.dataset.target === 'string') {
            params += '&target='+this.items.widget.dataset.target
        } else {
            params += '&target='+this.items.settlement.value
        }
        if(typeof this.items.widget.dataset.region === 'string') {
            params += '&region='+this.items.widget.dataset.region
        } else {
            params += '&region='+this.items.region.value
        }

        this.request(params).then((response) => {
            if(typeof response.fias === 'string') {
                eShopLogistic.params.settlement = {
                    "name": response.name,
                    "region": response.region,
                    "fias": response.fias,
                    "services": response.services
                }
                this.setSettlementRegion()
            } else {
                _self.items.infoBlock.innerHTML = eshoplogistic3Config.settlement_warning_message
                _self.items.infoBlock.style.display = 'block'
                _self.loaders.view('msCart', false)
                _self.loaders.view('msOrder', false)
            }
        })

        const msDelivery = document.querySelectorAll('input[name="delivery"]')
        msDelivery.forEach.call(msDelivery, function(element){
            element.addEventListener('click', event => {
                _self.run().then()
            })
        })
    },
    loaders: {
        items: {
            msCart: null,
            msOrder: null
        },
        html: '<div class="loader"><div class="spinner-border text-primary" role="status"></div><span>'+eshoplogistic3Config.loading_message+'</span></div>',
        create: function (block) {
            const container = document.getElementById(block)
            container.style.position = 'relative'
            let loader = document.createElement('div')
            loader.classList.add('eShopLogistic3WidgetLoading')
            loader.innerHTML = this.html
            this.items[block] = loader
            container.append(loader)
        },
        view: function (block, mode) {
            if(mode) {
                if (this.items[block] === null) {
                    this.create(block)
                } else {
                    this.items[block].style.display = 'block'
                }
            } else {
                if (this.items[block] !== null) {
                    this.items[block].style.display = 'none'
                }
            }
        }
    },
    validate: function () {
        if(this.items.delivery !== null) {
            if(this.items.delivery.checked) {
                return true
            }
        }
        return false
    },
    selectSettlement:  function (text) {
        this.request('action=search&target='+text).then((response) => {
            modalSearchForm.setData(response)
        })
    },
    setSettlementRegion: function () {
        const event = new Event('change')
        this.items.settlement.value = this.params.settlement.name
        this.items.settlement.dispatchEvent(event)
        if(this.items.region !== null) {
            this.items.region.value = this.params.settlement.region
            this.items.region.dispatchEvent(event)
        }
        this.run().then()
    },
    request: function (data) {
        return fetch(eshoplogistic3Config.actionUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-type': 'application/x-www-form-urlencoded'
            },
            body: data
        }).then((response ) => response.json())
    },
    getPaymentType: function () {
        let current_payment = document.querySelector('input[name=payment]:checked'),
            current_payment_id = current_payment.id.match(/(\d+)/)
        if(current_payment_id[0]) {
            for (const [key, value] of Object.entries(this.items.payments)) {
                if(value.indexOf(current_payment_id[0]) != -1) {
                    this.params.payment = key
                }
            }
        }
    },
    /*getOffers: async function () {
        this.request('action=offers').then((response) => {
            if(typeof response === 'object') {
                this.params.offers = JSON.stringify(response)
            }
        })
    },*/
    load: async function () {
        this.items.widget.dispatchEvent(new CustomEvent('eShopLogisticWidgetCart:loadApp'))
    },
    run: async function () {

        this.setDefaultDelivery(false)

        if(this.validate()) {

            if(document.getElementById('msCart')) {
                this.loaders.view('msCart', true)
            }

            this.loaders.view('msOrder', true)

            // определить текущий способ оплаты
            this.getPaymentType()

            // получить offers
            //await this.getOffers()
            let promise = new Promise((resolve, reject) => {
                this.request('action=offers').then((response) => {
                    if(typeof response === 'object') {
                        resolve(JSON.stringify(response))
                    }
                })
            })
            this.params.offers = await promise

            console.log(this.params.offers)

            if(!this.stateLoad) {
                await this.load()
            }

            console.log('load')

            this.items.widget.style.display = 'block'

            let params = {
                offers: this.params.offers,
                payment: this.params.payment
            }

            this.items.widget.dispatchEvent(new CustomEvent('eShopLogisticWidgetCart:updateParamsRequest', {
                detail: {
                    settlement: this.params.settlement,
                    requestParams: params
                }
            }))

        } else {
            this.items.widget.style.display = 'none'
            this.setInfo()
        }
    },
    setInfo: function (event = '', data = {}) {

        let deliveryData = {},
            sendData = false,
            getCost = false

        this.items.infoBlock.innerHTML = ''
        this.items.infoBlock.style.display = 'none'

        if(this.items.delivery !== null) {
            if (this.items.delivery.checked) {
                switch (event) {

                    case ('onAllServicesLoaded'):
                        sendData = getCost = true
                        this.items.infoBlock.innerHTML = eshoplogistic3Config.warning_message
                        this.items.infoBlock.style.display = 'block'
                        deliveryData = {
                            event: event
                        }
                        break

                    case ('onSelectedService'):

                        sendData = getCost = true
                        deliveryData = {
                            event: event,
                            delivery_id: eshoplogistic3Config.delivery_id,
                            settlement: {
                                name: eShopLogistic.params.settlement.name,
                                region: eShopLogistic.params.settlement.region,
                                fias: eShopLogistic.params.settlement.fias
                            },
                            service: {
                                code: data.service.code,
                                name: data.service.name
                            },
                            type: data.typeDelivery,
                            price: {
                                value: data.service.responseData[data.typeDelivery].price.value,
                                unit: data.service.responseData[data.typeDelivery].price.unit
                            },
                            time: {
                                value: data.service.responseData[data.typeDelivery].time.value,
                                unit: data.service.responseData[data.typeDelivery].time.unit,
                                text: data.service.responseData[data.typeDelivery].time.text
                            },
                            comments: {
                                service: data.service.comment ?? '',
                                type: data.service.responseData[data.typeDelivery].comment ?? ''
                            }
                        }

                        if(typeof data.service.responseData[data.typeDelivery].tariff == 'object') {
                            deliveryData.tariff = data.service.responseData[data.typeDelivery].tariff
                        }

                        if(typeof data.terminal == 'object') {
                            deliveryData.terminal = {
                                code: data.terminal.code,
                                name: data.terminal.name,
                                address: data.terminal.address,
                                phones: data.terminal.phones,
                                workTime: data.terminal.workTime,
                                lon: data.terminal.lon,
                                lat: data.terminal.lat,
                                is_postamat: data.terminal.is_postamat
                            }
                        }
                        break


                    case ('onNotAvailableServices'):
                        this.items.infoBlock.innerHTML = eshoplogistic3Config.fail_message
                        this.items.infoBlock.style.display = 'block'
                        break
                }
            }
        }

        if(sendData) {
            this.request('action=delivery&data='+JSON.stringify(deliveryData)).then((response) => {
                if(getCost) {
                    miniShop2.Order.getcost()
                }
                if(typeof response.info === 'string' && event != 'onAllServicesLoaded') {
                    this.items.infoBlock.innerHTML = response.info
                    this.items.infoBlock.style.display = 'block'
                }
            })
        }
    },
    setDefaultDelivery: function (no_delivery = true) {
        if(no_delivery) {
            this.items.delivery.disabled = true
            this.items.widget.style.display = 'none'
            this.items.defaultDelivery.click()
        } else {
            this.items.widget.style.display = 'block'
        }
        const noDeliveryMsg = document.querySelectorAll('.eShopLogistic3NoDelivery')
        noDeliveryMsg.forEach.call(noDeliveryMsg, function(element){
            element.innerHTML = no_delivery ? eshoplogistic3Config.no_delivery_message : ''
        })
    },

}


// запуск виджета + функции обратного вызова виджета
document.addEventListener('DOMContentLoaded', () => {

    const root = document.getElementById('eShopLogisticWidgetCart');

    if(root === null) {
        return
    }

    modalSearchForm.init()

    setTimeout(() => {

        eShopLogistic.init()

        eShopLogistic.items.widget.addEventListener('eShopLogisticWidgetCart:onNotAvailableServices', (event) => {
            console.log('Событие onNotAvailableServices')
            eShopLogistic.setDefaultDelivery(true)
            if(document.getElementById('msCart')) {
                eShopLogistic.loaders.view('msCart', false)
            }
            eShopLogistic.loaders.view('msOrder', false)
            eShopLogistic.setInfo('onNotAvailableServices')
        })

        root.addEventListener('eShopLogisticWidgetCart:onLoadApp', (event) => {
            const params = {
                offers: eShopLogistic.params.offers,
                payment: eShopLogistic.params.payment
            }

            if(eShopLogistic.params.payment === null) {
                console.log('eShopLogistic: проверьте настройки вариантов оплаты')
            }

            eShopLogistic.items.widget.dispatchEvent(new CustomEvent('eShopLogisticWidgetCart:updateParamsRequest', {
                detail: {
                    settlement: eShopLogistic.params.settlement,
                    requestParams: params
                }
            }))
            eShopLogistic.stateLoad = true
        });


        root.addEventListener('eShopLogisticWidgetCart:onSelectedService', (event) => {
            eShopLogistic.setInfo('onSelectedService', event.detail)
        })


        root.addEventListener('eShopLogisticWidgetCart:onAllServicesLoaded', (event) => {
            eShopLogistic.setInfo('onAllServicesLoaded')
            eShopLogistic.loaders.view('msCart', false)
            eShopLogistic.loaders.view('msOrder', false)
        })

        root.addEventListener('eShopLogisticWidgetCart:onInvalidServices', () => {
            console.log('Событие onInvalidServices')
            eShopLogistic.setDefaultDelivery(true)
            eShopLogistic.loaders.view('msCart', false)
            eShopLogistic.loaders.view('msOrder', false)
        })

        // root.addEventListener('eShopLogisticWidgetCart:onSelectTypeDelivery', (event) => {})
        // root.addEventListener('eShopLogisticWidgetCart:onInvalidSettlementCode', () => {})
        // root.addEventListener('eShopLogisticWidgetCart:onInvalidName', () => {})
        // root.addEventListener('eShopLogisticWidgetCart:onInvalidServices', () => {})
        // root.addEventListener('eShopLogisticWidgetCart:onInvalidPayment', () => {})
        // root.addEventListener('eShopLogisticWidgetCart:onInvalidOffers', () => {})
    }, 1000)


    // функции обратного вызова MS2
    if (typeof miniShop2 !== 'undefined') {
        miniShop2.Callbacks.add('Order.add.response.success', 'eShopLogistic3OrderAdd', function (response) {
            if (typeof response.data.payment == 'string') {
                if (eshoplogistic3Config.payment_on == 1) {
                    setTimeout(function () {
                        eShopLogistic.run().then()
                    }, 1000)
                }
            }
        })
        miniShop2.Callbacks.add('Cart.change.response.success', 'eShopLogistic3CartChange', function (response) {
            eShopLogistic.run().then()
        })
        miniShop2.Callbacks.add('Cart.remove.response.success', 'eShopLogistic3CartRemove', function (response) {
            eShopLogistic.run().then()
        })
    }
})