<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Profile Sidebar -->
            <div class="col-lg-4">
                <div class="card ambient-shadow rounded-4 p-4 text-center border-0 bg-white">
                    <div id="user-avatar-container" class="mb-3">
                        <img src="/assets/images/default-avatar.png" id="user-photo" class="rounded-circle shadow-sm" width="100">
                    </div>
                    <h4 class="serif" id="user-name">Loading...</h4>
                    <p class="text-muted small" id="user-email"></p>
                    <hr class="my-4 opacity-25">
                    <button onclick="logout()" class="btn btn-outline-rose w-100 rounded-pill">Sign Out</button>
                </div>
            </div>

            <!-- Main Content: Orders & Consultations -->
            <div class="col-lg-8">
                <h2 class="serif mb-4">Your Floral Journey</h2>
                
                <div class="card border-0 rounded-4 ambient-shadow mb-4">
                    <div class="card-body p-4">
                        <h5 class="serif border-bottom pb-3 mb-3">Pending Consultations</h5>
                        <div id="user-consultations">
                            <!-- Real-time Firestore Feed -->
                        </div>
                    </div>
                </div>

                <div class="card border-0 rounded-4 ambient-shadow">
                    <div class="card-body p-4">
                        <h5 class="serif border-bottom pb-3 mb-3">Order History</h5>
                        <div id="user-orders" class="text-muted small">
                            No orders found yet. Start your legacy today.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="module">
    import { auth, db } from "/assets/js/firebase-init.js";
    import { onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";
    import { collection, query, where, onSnapshot } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    onAuthStateChanged(auth, (user) => {
        if (user) {
            document.getElementById('user-name').innerText = user.displayName || "Valued Client";
            document.getElementById('user-email').innerText = user.email;
            if(user.photoURL) document.getElementById('user-photo').src = user.photoURL;

            // Load User Inquiries
            const q = query(collection(db, "events_inquiries"), where("uid", "==", user.uid));
            onSnapshot(q, (snapshot) => {
                const container = document.getElementById('user-consultations');
                container.innerHTML = snapshot.empty ? "No consultations booked." : "";
                snapshot.forEach(doc => {
                    const data = doc.data();
                    container.innerHTML += `
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded-3">
                            <div>
                                <span class="fw-bold text-rose">${data.type}</span><br>
                                <small class="text-muted">Date: ${data.date}</small>
                            </div>
                            <span class="badge bg-white text-rose border border-rose rounded-pill">${data.status}</span>
                        </div>
                    `;
                });
            });
        } else {
            window.location.href = "/login";
        }
    });

    window.logout = () => signOut(auth).then(() => window.location.href = "/");
</script>