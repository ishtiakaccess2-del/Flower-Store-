<div class="card border-0 rounded-4 ambient-shadow p-5 bg-white">
    <h3 class="serif mb-4 text-rose">Create Promotional Pass</h3>
    <form id="couponForm" class="row g-3">
        <div class="col-md-4">
            <input type="text" id="cCode" class="form-control rounded-pill px-4" placeholder="Code: e.g. BLOOM25" required>
        </div>
        <div class="col-md-3">
            <input type="number" id="cDiscount" class="form-control rounded-pill px-4" placeholder="Discount %" required>
        </div>
        <div class="col-md-3">
            <input type="date" id="cExpiry" class="form-control rounded-pill px-4" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-rose w-100 rounded-pill">Activate</button>
        </div>
    </form>
</div>

<script type="module">
    import { db } from "/assets/js/firebase-init.js";
    import { collection, addDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    document.getElementById('couponForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        await addDoc(collection(db, "coupons"), {
            code: document.getElementById('cCode').value.toUpperCase(),
            discount: parseInt(document.getElementById('cDiscount').value),
            expiry: document.getElementById('cExpiry').value,
            active: true,
            createdAt: serverTimestamp()
        });
        alert("Marketing code is now live!");
    });
</script>