<section class="mt-4">
    <div class="card border-0 rounded-4 ambient-shadow">
        <div class="card-body p-5">
            <h3 class="serif mb-4">Add New Masterpiece</h3>
            <form id="product-form" class="row g-4">
                <div class="col-md-6">
                    <label class="form-label">Bouquet Name</label>
                    <input type="text" class="form-control rounded-3" id="pName" placeholder="e.g. Midnight Velvet" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Base Price ($)</label>
                    <input type="number" class="form-control rounded-3" id="pPrice" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Category</label>
                    <select class="form-select rounded-3" id="pCategory">
                        <option>Wedding</option>
                        <option>Sympathy</option>
                        <option>Corporate</option>
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Floral Composition (Description)</label>
                    <textarea class="form-control rounded-3" id="pDesc" rows="3"></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">High-Resolution Image</label>
                    <input type="file" class="form-control rounded-3" id="pImage" accept="image/*" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-rose px-5 shadow-lg">Upload to Boutique</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script type="module">
    import { db, storage } from "/assets/js/firebase-init.js";
    import { ref, uploadBytes, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-storage.js";
    import { collection, addDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    document.getElementById('product-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const file = document.getElementById('pImage').files[0];
        
        // 1. Upload to Firebase Storage
        const storageRef = ref(storage, 'products/' + file.name);
        const snapshot = await uploadBytes(storageRef, file);
        const downloadURL = await getDownloadURL(snapshot.ref);

        // 2. Save Metadata to Firestore
        await addDoc(collection(db, "products"), {
            name: document.getElementById('pName').value,
            price: parseFloat(document.getElementById('pPrice').value),
            category: document.getElementById('pCategory').value,
            description: document.getElementById('pDesc').value,
            imageUrl: downloadURL,
            createdAt: new Date()
        });

        alert("Product listed successfully!");
        location.reload();
    });
</script>