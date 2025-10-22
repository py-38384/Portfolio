import '@simonwep/pickr/dist/themes/nano.min.css'  
import Pickr from '@simonwep/pickr'
const color_picker_1 = document.querySelector('.color-picker-1')
if(color_picker_1){
    const pickr1 = Pickr.create({
        el: '.color-picker-1',
        theme: 'nano', // or 'monolith', or 'nano'
        default: window.frontend.theme_colors.primary_body_color,
        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],
    
        components: {
    
            // Main components
            preview: true,
            opacity: true,
            hue: true,
    
            // Input / output Options
            interaction: {
                hex: true,
                rgba: true,
                hsla: true,
                hsva: true,
                cmyk: true,
                input: true,
                clear: true,
                save: true
            }
        }
    });
    pickr1.on('save',(color, instance) => {
        const colorValue = color.toRGBA().toString()
        document.querySelector('#primary_body_color').value = colorValue
        console.log(`Color Value for: primary_body_color - ${colorValue}`)
    })
}
const color_picker_2 = document.querySelector('.color-picker-2')
if(color_picker_2){
    const pickr2 = Pickr.create({
        el: '.color-picker-2',
        theme: 'nano', // or 'monolith', or 'nano'
        default: window.frontend.theme_colors.active_text_color,
        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],
    
        components: {
    
            // Main components
            preview: true,
            opacity: true,
            hue: true,
    
            // Input / output Options
            interaction: {
                hex: true,
                rgba: true,
                hsla: true,
                hsva: true,
                cmyk: true,
                input: true,
                clear: true,
                save: true
            }
        }
    });
    pickr2.on('save',(color, instance) => {
        const colorValue = color.toRGBA().toString()
        document.querySelector('#active_text_color').value = colorValue
        console.log(`Color Value for: active_text_color - ${colorValue}`)
    })
}
const color_picker_3 = document.querySelector('.color-picker-3')
if(color_picker_3){
    const pickr3 = Pickr.create({
        el: '.color-picker-3',
        theme: 'nano', // or 'monolith', or 'nano'
        default: window.frontend.theme_colors.outline_default_color,
        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],
    
        components: {
    
            // Main components
            preview: true,
            opacity: true,
            hue: true,
    
            // Input / output Options
            interaction: {
                hex: true,
                rgba: true,
                hsla: true,
                hsva: true,
                cmyk: true,
                input: true,
                clear: true,
                save: true
            }
        }
    });
    pickr3.on('save',(color, instance) => {
        const colorValue = color.toRGBA().toString()
        document.querySelector('#outline_default_color').value = colorValue
        console.log(`Color Value for: outline_default_color - ${colorValue}`)
    })
}
const color_picker_4 = document.querySelector('.color-picker-4')
if(color_picker_4){

    const pickr4 = Pickr.create({
        el: '.color-picker-4',
        theme: 'nano', // or 'monolith', or 'nano'
        default: window.frontend.theme_colors.box_shadow_color,
        swatches: [
            'rgba(244, 67, 54, 1)',
            'rgba(233, 30, 99, 0.95)',
            'rgba(156, 39, 176, 0.9)',
            'rgba(103, 58, 183, 0.85)',
            'rgba(63, 81, 181, 0.8)',
            'rgba(33, 150, 243, 0.75)',
            'rgba(3, 169, 244, 0.7)',
            'rgba(0, 188, 212, 0.7)',
            'rgba(0, 150, 136, 0.75)',
            'rgba(76, 175, 80, 0.8)',
            'rgba(139, 195, 74, 0.85)',
            'rgba(205, 220, 57, 0.9)',
            'rgba(255, 235, 59, 0.95)',
            'rgba(255, 193, 7, 1)'
        ],
    
        components: {
    
            // Main components
            preview: true,
            opacity: true,
            hue: true,
    
            // Input / output Options
            interaction: {
                hex: true,
                rgba: true,
                hsla: true,
                hsva: true,
                cmyk: true,
                input: true,
                clear: true,
                save: true
            }
        }
    });
    pickr4.on('save',(color, instance) => {
        const colorValue = color.toRGBA().toString()
        document.querySelector('#box_shadow_color').value = colorValue
        console.log(`Color Value for: box_shadow_color - ${colorValue}`)
    })
}