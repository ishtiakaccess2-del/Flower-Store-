export const cart = {
    items: JSON.parse(localStorage.getItem('gc_cart')) || [],
    
    add(product) {
        this.items.push(product);
        this.save();
        alert(`${product.name} added to your floral selection.`);
    },

    save() {
        localStorage.setItem('gc_cart', JSON.stringify(this.items));
        this.updateUI();
    },

    getTotal() {
        return this.items.reduce((sum, item) => sum + item.price, 0);
    },

    // The WhatsApp "Frictionless" Order Logic (2026 Standard)
    async finalizeOrder() {
        let message = "🌸 *New Order from Golap-Canon*%0A%0A";
        this.items.forEach((item, index) => {
            message += `${index + 1}. *${item.name}* (${item.size}) - $${item.price}%0A`;
        });
        message += `%0A💰 *Total: $${this.getTotal()}*%0A%0APlease confirm my delivery!`;
        
        const whatsappNumber = "8801XXXXXXXXX"; // Replace with store owner number
        window.open(`https://wa.me/${whatsappNumber}?text=${message}`, '_blank');
        
        // Optional: Clear cart after redirect
        // localStorage.removeItem('gc_cart');
    }
};