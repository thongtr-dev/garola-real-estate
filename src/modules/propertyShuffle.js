import Shuffle from 'shufflejs';

class PropertyShuffle {
    constructor() {
        
        this.shuffleFilter = document.querySelector('.shuffle-filter');
        if(this.shuffleFilter === null) return;

        this.shuffleFilterItems = this.shuffleFilter.childNodes;
        
        this.shuffleContainer = document.querySelector('.shuffle-container');
        
        this.shuffleInstance = new Shuffle(this.shuffleContainer, {
            itemSelector: '.property-shuffle-item'
        });
        this.event();
    }

    event() {
        const shuffleInstance = this.shuffleInstance;
        this.shuffleFilterItems.forEach(item => {
            item.addEventListener('click', function (){
                const selected = document.querySelector('.selected');
                if (selected) {
                    selected.classList.remove('selected');
                }
                this.classList.add('selected');
                shuffleInstance.filter(this.dataset.target);
            })
        });
    }
}

export default PropertyShuffle;