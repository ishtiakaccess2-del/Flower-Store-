<script type="module">
    import { cart } from "/assets/js/cart-system.js";

    const prices = {
        'Standard': 85,
        'Deluxe': 115,
        'Premium': 145
    };

    let selectedSize = 'Standard';

    // Handle Size Selection
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            selectedSize = e.target.innerText;
            document.getElementById('display-price').innerText = `$${prices[selectedSize]}.00`;
            
            // UI Toggle
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('btn-primary'));
            e.target.classList.add('btn-primary');
        });
    });

    // Add to Cart Function
    document.getElementById('add-to-cart-btn').addEventListener('click', () => {
        const item = {
            pid: '<?= $product['pid'] ?>',
            name: 'Blushing Romance Bouquet',
            size: selectedSize,
            price: prices[selectedSize],
            image: '<?= $product['imageUrl'] ?>'
        };
        cart.add(item);
    });
</script>