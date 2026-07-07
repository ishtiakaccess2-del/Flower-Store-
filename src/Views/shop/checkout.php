<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <h2 class="serif mb-4">Shipping & Delivery</h2>
            <div class="card border-0 rounded-4 ambient-shadow p-4 bg-white">
                <form id="shippingForm">
                    <div class="mb-3">
                        <label class="small fw-bold">Delivery Address</label>
                        <textarea id="address" class="form-control border-0 bg-light rounded-3" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="small fw-bold">Delivery Date</label>
                        <input type="date" id="deliveryDate" class="form-control border-0 bg-light rounded-3" required>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 rounded-4 ambient-shadow p-4 bg-white sticky-top" style="top:100px;">
                <h4 class="serif border-bottom pb-3">Order Summary</h4>
                <div id="checkout-items" class="py-3"></div>
                
                <div class="input-group mb-3 mt-2">
                    <input type="text" id="couponInput" class="form-control border-0 bg-light rounded-start-pill px-3" placeholder="Promo Code">
                    <button id="applyCoupon" class="btn btn-dark rounded-end-pill px-4">Apply</button>
                </div>

                <div class="d-flex justify-content-between h5 mb-4 px-2">
                    <span class="serif">Total</span>
                    <span class="text-rose fw-bold" id="finalTotal">$0.00</span>
                </div>

                <button id="placeOrder" class="btn btn-rose w-100 py-3 rounded-pill fw-bold text-uppercase shadow-lg">
                    Finalize WhatsApp Order
                </button>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import { cart } from "/assets/js/cart-system.js";
    import { db } from "/assets/js/firebase-init.js";
    import { collection, query, where, getDocs } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    let discount = 0;

    document.getElementById('applyCoupon').addEventListener('click', async () => {
        const code = document.getElementById('couponInput').value.toUpperCase();
        const q = query(collection(db, "coupons"), where("code", "==", code), where("active", "==", true));
        const snap = await getDocs(q);
        
        if(!snap.empty) {
            discount = snap.docs[0].data().discount;
            alert(`Applied ${discount}% discount!`);
            updateSummary();
        } else {
            alert("Invalid or expired code.");
        }
    });

    const updateSummary = () => {
        const total = cart.getTotal();
        const final = total - (total * (discount / 100));
        document.getElementById('finalTotal').innerText = `$${final.toFixed(2)}`;
    };

    document.getElementById('placeOrder').addEventListener('click', () => {
        const addr = document.getElementById('address').value;
        const date = document.getElementById('deliveryDate').value;
        if(!addr || !date) return alert("Please fill in delivery details.");
        
        // Formulate WhatsApp message with Address and Date
        cart.finalizeOrder(addr, date, discount);
    });

    updateSummary();
</script>