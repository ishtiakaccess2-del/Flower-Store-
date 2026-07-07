<div class="card border-0 rounded-4 ambient-shadow p-4 bg-white mt-4">
    <h5 class="serif mb-3">Add to The Living Gallery</h5>
    <form id="reviewForm">
        <div class="mb-3">
            <div class="star-rating fs-4 text-warning">
                <i class="bi bi-star cursor-pointer" data-rating="1"></i>
                <i class="bi bi-star cursor-pointer" data-rating="2"></i>
                <i class="bi bi-star cursor-pointer" data-rating="3"></i>
                <i class="bi bi-star cursor-pointer" data-rating="4"></i>
                <i class="bi bi-star cursor-pointer" data-rating="5"></i>
            </div>
        </div>
        <textarea id="reviewText" class="form-control border-0 bg-light rounded-3 mb-3" placeholder="Share the feeling..."></textarea>
        <input type="file" id="reviewPhoto" class="form-control border-0 bg-light rounded-3 mb-3" accept="image/*">
        <button type="submit" class="btn btn-rose w-100 rounded-pill">Submit to Gallery</button>
    </form>
</div>

<script type="module">
    import { db, storage, auth } from "/assets/js/firebase-init.js";
    import { ref, uploadBytes, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-storage.js";
    import { collection, addDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    document.getElementById('reviewForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const user = auth.currentUser;
        if(!user) return alert("Please sign in to leave a review.");

        const file = document.getElementById('reviewPhoto').files[0];
        let photoUrl = "";

        if(file) {
            const storageRef = ref(storage, `gallery/${Date.now()}_${file.name}`);
            const upload = await uploadBytes(storageRef, file);
            photoUrl = await getDownloadURL(upload.ref);
        }

        await addDoc(collection(db, "reviews"), {
            uid: user.uid,
            userName: user.displayName,
            text: document.getElementById('reviewText').value,
            photo: photoUrl,
            rating: 5, // Logic to capture stars can be added
            productId: "current-product-id",
            createdAt: new Date()
        });

        alert("Your bloom is now part of our Living Gallery!");
        location.reload();
    });
</script>