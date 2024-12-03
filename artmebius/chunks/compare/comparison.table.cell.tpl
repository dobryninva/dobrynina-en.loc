{if $type in ['checkbox','combo-boolean']}{set $value = ($value == 1) ? 'есть' : 'нет'}{/if}
<td class="comparison-cell{$classes}">{$value} {$measure_unit}</td>