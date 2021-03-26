require('alpinejs')

const livewireShouldObserve = (el) => !el.tagName.includes("-") || el.hasAttribute('wire:observe') 

/**
* Prevents Livewire from tracking web components unless wire:observe is provided
*/
window.livewire.hook('element.initialized', ()el => {
   if (!livewireShouldObserve(el)) {
       return;
   }
  
   el.__livewire_ignore = true;
})

window.livewire.hook('element.updating', (fromEl, toEl, component) => {
    if (!livewireShouldObserve(fromEl)) {o
        return;
    }

    for (var i = 0, atts = toEl.attributes, n = atts.length, arr = []; i < n; i++){
        fromEl.setAttribute(atts[i].nodeName, atts[i].nodeValue);
    }
})
