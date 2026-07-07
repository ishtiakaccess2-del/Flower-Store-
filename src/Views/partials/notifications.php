<div class="dropdown">
    <button class="btn btn-link text-dark position-relative" data-bs-toggle="dropdown">
        <i class="bi bi-bell fs-4"></i>
        <span id="notif-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
            0
        </span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end rounded-4 shadow border-0 p-3" id="notif-list" style="width: 300px;">
        <li class="small text-muted mb-2 border-bottom pb-2">Recent Notifications</li>
        <!-- Items load here -->
    </ul>
</div>

<script type="module">
    import { db, auth } from "/assets/js/firebase-init.js";
    import { collection, query, where, onSnapshot } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    auth.onAuthStateChanged(user => {
        if (user) {
            const q = query(collection(db, "notifications"), where("uid", "==", user.uid), where("read", "==", false));
            onSnapshot(q, (snapshot) => {
                const badge = document.getElementById('notif-badge');
                const list = document.getElementById('notif-list');
                
                if (!snapshot.empty) {
                    badge.classList.remove('d-none');
                    badge.innerText = snapshot.size;
                    
                    snapshot.forEach(doc => {
                        const n = doc.data();
                        list.innerHTML += `
                            <li class="mb-3">
                                <div class="d-flex gap-2">
                                    <i class="bi bi-info-circle text-rose"></i>
                                    <div>
                                        <p class="mb-0 small fw-bold">${n.title}</p>
                                        <p class="mb-0 x-small text-muted">${n.message}</p>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                } else {
                    list.innerHTML = `<li class="small text-center text-muted">All caught up!</li>`;
                }
            });
        }
    });
</script>