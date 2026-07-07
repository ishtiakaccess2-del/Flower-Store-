<?php
use App\Middleware\AdminMiddleware;
AdminMiddleware::check(); // Protect the route
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-white shadow-sm vh-100 position-fixed pt-5">
            <div class="sidebar-sticky px-4">
                <h4 class="serif text-rose mb-5">Admin Console</h4>
                <ul class="nav flex-column gap-3 fw-bold small text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link text-rose border-start border-4 border-rose" href="/admin/dashboard">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="/admin/orders">
                            <i class="bi bi-bag-check me-2"></i> Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="/admin/products">
                            <i class="bi bi-flower1 me-2"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-muted" href="/admin/inquiries">
                            <i class="bi bi-calendar-event me-2"></i> Inquiries
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto px-md-5 pt-5 bg-light min-vh-100">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="serif h2">Overview</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-rose rounded-pill px-3">
                        <i class="bi bi-download"></i> Export Report
                    </button>
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 ambient-shadow p-4 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-rose-light p-3 rounded-circle text-rose me-3">
                                <i class="bi bi-currency-dollar fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-0">Total Revenue</h6>
                                <h3 class="fw-bold mb-0" id="total-revenue">$0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 rounded-4 ambient-shadow p-4 bg-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-emerald-light p-3 rounded-circle text-success me-3">
                                <i class="bi bi-calendar-check fs-3"></i>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-0">Pending Inquiries</h6>
                                <h3 class="fw-bold mb-0" id="pending-count">0</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Real-time Inquiry Table -->
            <div class="card border-0 rounded-4 ambient-shadow overflow-hidden">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h5 class="serif mb-0">Recent Event Inquiries</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4">Type</th>
                                <th>Date Requested</th>
                                <th>Client</th>
                                <th>Status</th>
                                <th class="text-end px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody id="inquiry-list">
                            <!-- Populated via JS Firebase Listener -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script type="module">
    import { db } from "/assets/js/firebase-init.js";
    import { collection, onSnapshot, query, orderBy, limit } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    // Listen for New Inquiries in Real-time
    const q = query(collection(db, "events_inquiries"), orderBy("createdAt", "desc"), limit(10));
    onSnapshot(q, (snapshot) => {
        const list = document.getElementById('inquiry-list');
        list.innerHTML = '';
        document.getElementById('pending-count').innerText = snapshot.size;

        snapshot.forEach((doc) => {
            const data = doc.data();
            list.innerHTML += `
                <tr>
                    <td class="px-4 fw-bold text-secondary">${data.type}</td>
                    <td>${data.date}</td>
                    <td>${data.userName || 'Guest'}</td>
                    <td><span class="badge bg-soft-rose text-rose rounded-pill px-3">${data.status}</span></td>
                    <td class="text-end px-4">
                        <button class="btn btn-sm btn-outline-dark rounded-circle"><i class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-rose rounded-pill ms-2" onclick="respond('${doc.id}')">Respond</button>
                    </td>
                </tr>
            `;
        });
    });
</script>