<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Filter Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 bg-white rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="serif mb-4">Refine Selection</h5>
                    
                    <div class="mb-4">
                        <label class="small fw-bold text-uppercase tracking-wider">Search</label>
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control border-0 bg-light" placeholder="Search blooms...">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="small fw-bold text-uppercase tracking-wider">Collections</label>
                        <div class="d-flex flex-column gap-2 mt-2">
                            <button class="filter-btn btn btn-sm btn-outline-rose rounded-pill text-start active" data-category="All">All Masterpieces</button>
                            <button class="filter-btn btn btn-sm btn-outline-rose rounded-pill text-start" data-category="Wedding">Wedding Collection</button>
                            <button class="filter-btn btn btn-sm btn-outline-rose rounded-pill text-start" data-category="Corporate">Corporate Galas</button>
                            <button class="filter-btn btn btn-sm btn-outline-rose rounded-pill text-start" data-category="Sympathy">Sympathy & Grace</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="col-lg-9">
                <div class="row g-4" id="product-grid">
                    <!-- Dynamic Items -->
                </div>
                <div id="no-results" class="text-center py-5 d-none">
                    <i class="bi bi-search fs-1 text-muted opacity-25"></i>
                    <p class="mt-3 serif h4">No matches found in our gardens.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="module">
    import { db } from "/assets/js/firebase-init.js";
    import { collection, query, where, onSnapshot } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

    let currentCategory = "All";
    let allProducts = [];

    const fetchProducts = () => {
        const q = collection(db, "products");
        onSnapshot(q, (snapshot) => {
            allProducts = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
            renderProducts();
        });
    };

    const renderProducts = () => {
        const grid = document.getElementById('product-grid');
        const searchVal = document.getElementById('searchInput').value.toLowerCase();
        grid.innerHTML = '';
        
        const filtered = allProducts.filter(p => {
            const matchesCat = currentCategory === "All" || p.category === currentCategory;
            const matchesSearch = p.name.toLowerCase().includes(searchVal);
            return matchesCat && matchesSearch;
        });

        if (filtered.length === 0) document.getElementById('no-results').classList.remove('d-none');
        else document.getElementById('no-results').classList.add('d-none');

        filtered.forEach(p => {
            grid.innerHTML += `
                <div class="col-md-4">
                    <div class="card ambient-shadow border-0 rounded-4 h-100 overflow-hidden">
                        <img src="${p.imageUrl}" class="card-img-top" style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <span class="text-rose small fw-bold">${p.category}</span>
                            <h5 class="serif mt-1">${p.name}</h5>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="fw-bold h5 mb-0">$${p.price}</span>
                                <a href="/product?id=${p.id}" class="btn btn-sm btn-outline-rose rounded-pill px-3">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        });
    };

    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            e.target.classList.add('active');
            currentCategory = e.target.dataset.category;
            renderProducts();
        });
    });

    document.getElementById('searchInput').addEventListener('input', renderProducts);
    fetchProducts();
</script>