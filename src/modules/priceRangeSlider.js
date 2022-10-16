import noUiSlider from 'nouislider';
import wNumb from 'wnumb';

class PriceRangeSlider{
    constructor() {
        this.sliderClass = document.querySelector('.price-range-slider');
        if (this.sliderClass === null) return;

        this.minRentPrice = this.sliderClass.dataset.min_rent_price;
        this.maxRentPrice = this.sliderClass.dataset.max_rent_price;

        this.minSalePrice = this.sliderClass.dataset.min_sale_price;
        this.maxSalePrice = this.sliderClass.dataset.max_sale_price;

        this.minPriceInput = document.querySelector('#min_price');
        this.maxPriceInput = document.querySelector('#max_price');
        
        this.statusSelect= document.querySelector('#status');
        
        this.slider = this.createSlider(this.minRentPrice, this.maxRentPrice);
        this.sliderEvent();
        this.assignInput();
        this.updateInput();
    }

    sliderEvent() {
        this.statusSelect.addEventListener('change', (event) => {
            if(event.target.value === 'For Rent') {
                this.updateSlider(this.minRentPrice, this.maxRentPrice);
            }
            else if (event.target.value === 'For Sale') {
                this.updateSlider(this.minSalePrice, this.maxSalePrice);
            }
        });
    }

    createSlider(min, max) {
        const slider = noUiSlider.create(this.sliderClass, {
            start: [min, max],
            tooltips: [wNumb({ decimals: 0, prefix: '&#36;' }), wNumb({ decimals: 0, prefix: '&#36;', })],
            connect: true,
            range: {
                'min': parseInt(min), 
                'max': parseInt(max)
            },
            step: 100
        });
        return slider;
    }

    updateSlider(min, max) {
        this.slider.updateOptions({
            start: [min, max],
            range: {
                'min': parseInt(min),
                'max': parseInt(max), 
            }
        });
    }

    assignInput() {
        this.slider.on('update', (values, handle) => {
            let value = values[handle];
            if (handle) {
                this.maxPriceInput.value = Math.round(value);
            } else {
                this.minPriceInput.value = Math.round(value);
            }
        });
    }

    updateInput() {
        this.minPriceInput.addEventListener('change', () => {
            this.slider.set([this.value, null]);
        });
        
        this.maxPriceInput.addEventListener('change', () => {
            this.slider.set([null, this.value]);
        });
    }
}

export default PriceRangeSlider;