<div>
    <canvas
        x-data="{
            chart: null,

            init: function () {
                let chart = new Chart($el, {
                    type: 'line',
                    data: @js($this->getData()),
                })

                $wire.on('updateChartData', async ({ data }) => {
                    chart.data = data
                    chart.update('resize')
                })
            }
        }"
        style="height: 320px;">
        wire:ignore>
    </canvas>
</div>
