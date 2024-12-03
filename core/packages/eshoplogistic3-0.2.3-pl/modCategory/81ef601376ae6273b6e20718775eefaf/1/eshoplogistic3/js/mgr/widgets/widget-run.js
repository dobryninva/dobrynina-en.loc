document.addEventListener('click', function(event){
    const element = event.target.closest('#eslWidgetRun')

    if(element){

        const container = document.getElementById('widgetContainer'),
            root = document.getElementById('eShopLogisticWidgetModal'),
            offers = document.getElementById('esl_widget_delivery_offers'),
            key = document.getElementById('esl_widget_delivery_key'),
            button = document.getElementById('eslWidgetRun'),
            attributes = ['title','from', 'offers']

        root.dataset.offers = offers.value
        root.dataset.key = key.value

        root.dispatchEvent(new CustomEvent('eShopLogisticWidgetModal:loadApp'))
        attributes.forEach((attribute) => {
            if(event?.target?.dataset?.[attribute]){
                root.setAttribute('data-'+attribute, event.target.dataset[attribute])
            }
        })
        root.dispatchEvent(new CustomEvent('eShopLogisticWidgetModal:open'))

        /* для статичного виджета
        const container = document.getElementById('widgetContainer'),
            root = document.getElementById('eShopLogisticWidgetBlock'),
            offers = document.getElementById('esl_widget_delivery_offers'),
            key = document.getElementById('esl_widget_delivery_key'),
            button = document.getElementById('eslWidgetRun')

        root.dataset.offers = offers.value
        root.dataset.key = key.value

        container.appendChild(root)
        root.style.display = 'block'
        button.style.display = 'none'

        root.dispatchEvent(new CustomEvent('eShopLogisticWidgetBlock:loadApp'))*/
    }
})

/* для статичного виджета: eShopLogisticWidgetBlock */
document.addEventListener('DOMContentLoaded', () => {

    const rootId = document.getElementById('eShopLogisticWidgetModal')

    rootId.addEventListener('eShopLogisticWidgetModal:onSelectedService', (event) => {

        const service = document.getElementById('esl_widget_delivery_service'),
            type = document.getElementById('esl_widget_delivery_type'),
            price = document.getElementById('esl_widget_delivery_price'),
            time = document.getElementById('esl_widget_delivery_time'),
            pvz = document.getElementById('esl_widget_delivery_pvz')

        // объект для сохранения в properties заказа
        let data = {
            service: {},
            tariff: {},
            comments: {},
            terminal: {},
            type: '',
            price: {},
            time: {},
        }

        console.log(event.detail)

        if(typeof event.detail.service === 'object') {
            if(typeof event.detail.service.name === 'string') {
                data.service.code = event.detail.service.code
                data.service.name = event.detail.service.name
                service.value = event.detail.service.name
            }
        }

        if(typeof event.detail.typeDelivery === 'string') {
            const typeDelivery = event.detail.typeDelivery

            data.type = typeDelivery
            type.value = (typeDelivery === 'door') ? 'курьер' : 'до пункта самовывоза'

            if(typeof event.detail.service.responseData[typeDelivery] === 'object') {
                if(typeof event.detail.service.responseData[typeDelivery].price === 'object') {
                    data.price.value = event.detail.service.responseData[typeDelivery].price.value
                    data.price.unit = event.detail.service.responseData[typeDelivery].price.unit
                    if(typeof  event.detail.service.responseData[typeDelivery].base !== 'undefined') {
                        data.price.base = event.detail.service.responseData[typeDelivery].price.base
                    }
                    price.value = event.detail.service.responseData[typeDelivery].price.value + ' ' + event.detail.service.responseData[typeDelivery].price.unit
                }
                if(typeof event.detail.service.responseData[typeDelivery].time === 'object') {
                    data.time.value = event.detail.service.responseData[typeDelivery].time.value
                    data.time.unit = event.detail.service.responseData[typeDelivery].time.unit
                    time.value = event.detail.service.responseData[typeDelivery].time.value + ' ' + event.detail.service.responseData[typeDelivery].time.unit
                }
            }

            if(typeof event.detail.service.responseData[typeDelivery].tariff === 'object') {
                data.tariff.code = event.detail.service.responseData[typeDelivery].tariff.code
                data.tariff.name = event.detail.service.responseData[typeDelivery].tariff.name
            }

            if(typeof event.detail.service.comment === 'string') {
                data.comments.service = event.detail.service.comment
            }

            if(typeof event.detail.service.responseData[typeDelivery].comment === 'string') {
                data.comments.type = event.detail.service.responseData[typeDelivery].comment
            }
        }

        if(typeof event.detail.terminal === 'object') {
            if(typeof event.detail.terminal.address === 'string') {
                let pvzText = event.detail.terminal.address
                if(typeof event.detail.terminal.code === 'string') {
                    pvzText += ', код:' + event.detail.terminal.code;
                }
                if(typeof event.detail.terminal.name === 'string') {
                    pvzText += ', название:' + event.detail.terminal.name;
                }
                pvz.value = pvzText
                data.terminal = event.detail.terminal
            }
        } else {
            pvz.value = ''
            data.pvz = ''
        }

        document.getElementById('esl_widget_delivery_data').value = JSON.stringify(data)

        if(event.detail.typeDelivery === 'door') {
            rootId.dispatchEvent(new CustomEvent('eShopLogisticWidgetModal:close'))
        } else {
            if (typeof event.detail.terminal === 'object') {
                rootId.dispatchEvent(new CustomEvent('eShopLogisticWidgetModal:close'))
            }
        }

    })

    rootId.addEventListener('eShopLogisticWidgetModal:onSelectedSettlement', (event) => {

        const settlement = document.getElementById('esl_widget_delivery_settlement')

        let settlement_value = '',
            data = {name: '', fias: '', region: ''}

        if(typeof event.detail.type === 'string') {
            settlement_value += event.detail.type + ' '
        }
        if(typeof event.detail.name === 'string') {
            settlement_value += event.detail.name
            data.name = event.detail.name
        }
        if(typeof event.detail.fias === 'string') {
            data.fias = event.detail.fias
        }

        if(typeof event.detail.region === 'string') {
            data.region = event.detail.region
            settlement_value += ', ' + event.detail.region
        }

        settlement.value = settlement_value

        document.getElementById('esl_widget_delivery_settlement_data').value = JSON.stringify(data)
    })

})

