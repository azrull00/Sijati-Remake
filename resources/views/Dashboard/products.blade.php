@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Produk</h1>
        </div>

        <!-- Search and Filter -->
        <div class="mb-6 flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" id="searchInput" placeholder="Cari produk..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex gap-4">
                <select id="sortBy"
                    class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="nama_asc">Nama (A-Z)</option>
                    <option value="nama_desc">Nama (Z-A)</option>
                    <option value="harga_asc">Harga (Rendah-Tinggi)</option>
                    <option value="harga_desc">Harga (Tinggi-Rendah)</option>
                </select>
                <button id="btnTambah" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Tambah Produk
                </button>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="productsTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>

        <!-- Modal Form -->
        <div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold" id="modalTitle">Tambah Produk</h3>
                    <button class="text-gray-500 hover:text-gray-700" onclick="closeModal()">×</button>
                </div>

                <form id="productForm" class="space-y-4">
                    <input type="hidden" id="produk_id">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-500">Rp</span>
                            <input type="number" id="harga" name="harga"
                                class="w-full pl-10 pr-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                min="100" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3"
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();

            document.getElementById('btnTambah').addEventListener('click', () => openModal());
            document.getElementById('searchInput').addEventListener('input', filterProducts);
            document.getElementById('sortBy').addEventListener('change', filterProducts);
            document.getElementById('productForm').addEventListener('submit', handleSubmit);
        });

        async function handleSubmit(e) {
            e.preventDefault();

            try {
                const formData = {
                    nama_produk: document.getElementById('nama_produk').value,
                    harga: parseInt(document.getElementById('harga').value),
                    deskripsi: document.getElementById('deskripsi').value
                };

                const id = document.getElementById('produk_id').value;
                const url = id ? `/produk/${id}` : '/produk';
                const method = id ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Terjadi kesalahan pada server');
                }

                showAlert(data.message, 'success');
                closeModal();
                loadProducts();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message, 'error');
            }
        }

        let products = [];

        async function loadProducts() {
            try {
                const response = await fetch('/produk');
                if (!response.ok) throw new Error('Network response was not ok');
                const data = await response.json();
                products = data;
                renderProducts();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Error loading products', 'error');
            }
        }

        function renderProducts() {
            const tbody = document.querySelector('#productsTable tbody');
            tbody.innerHTML = '';

            products.forEach((product, index) => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">${index + 1}</td>
            <td class="px-6 py-4">${product.nama_produk}</td>
            <td class="px-6 py-4">Rp ${new Intl.NumberFormat('id-ID').format(product.harga)}</td>
            <td class="px-6 py-4">${product.deskripsi}</td>
            <td class="px-6 py-4">
                <button onclick="editProduct(${product.id})"
                        class="bg-blue-100 text-blue-600 px-3 py-1 rounded hover:bg-blue-200 mr-2">
                    Edit
                </button>
                <button onclick="deleteProduct(${product.id})"
                        class="bg-red-100 text-red-600 px-3 py-1 rounded hover:bg-red-200">
                    Hapus
                </button>
            </td>
        `;
                tbody.appendChild(tr);
            });
        }

        function filterProducts() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const sortBy = document.getElementById('sortBy').value;

            let filtered = [...products].filter(product =>
                product.nama_produk.toLowerCase().includes(searchTerm) ||
                product.deskripsi.toLowerCase().includes(searchTerm)
            );

            switch (sortBy) {
                case 'nama_asc':
                    filtered.sort((a, b) => a.nama_produk.localeCompare(b.nama_produk));
                    break;
                case 'nama_desc':
                    filtered.sort((a, b) => b.nama_produk.localeCompare(a.nama_produk));
                    break;
                case 'harga_asc':
                    filtered.sort((a, b) => a.harga - b.harga);
                    break;
                case 'harga_desc':
                    filtered.sort((a, b) => b.harga - a.harga);
                    break;
            }

            products = filtered;
            renderProducts();
        }

        function openModal(product = null) {
            const modal = document.getElementById('formModal');
            const form = document.getElementById('productForm');
            const modalTitle = document.getElementById('modalTitle');

            form.reset();
            document.getElementById('produk_id').value = '';

            if (product) {
                modalTitle.textContent = 'Edit Produk';
                document.getElementById('produk_id').value = product.id;
                document.getElementById('nama_produk').value = product.nama_produk;
                document.getElementById('harga').value = product.harga;
                document.getElementById('deskripsi').value = product.deskripsi;
            } else {
                modalTitle.textContent = 'Tambah Produk';
            }

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('formModal').classList.add('hidden');
        }

        async function handleSubmit(e) {
            e.preventDefault();

            const formData = {
                nama_produk: document.getElementById('nama_produk').value,
                harga: document.getElementById('harga').value,
                deskripsi: document.getElementById('deskripsi').value
            };

            const id = document.getElementById('produk_id').value;
            const url = id ? `/produk/${id}` : '/produk';
            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();
                showAlert(data.message, 'success');
                closeModal();
                loadProducts();
            } catch (error) {
                console.error('Error:', error);
                showAlert(error.message, 'error');
            }
        }

        async function editProduct(id) {
            try {
                const response = await fetch(`/produk/${id}`);
                if (!response.ok) throw new Error('Network response was not ok');
                const product = await response.json();
                openModal(product);
            } catch (error) {
                console.error('Error:', error);
                showAlert('Error loading product', 'error');
            }
        }

        async function deleteProduct(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus produk ini?')) return;

            try {
                const response = await fetch(`/produk/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();
                showAlert(data.message, 'success');
                loadProducts();
            } catch (error) {
                console.error('Error:', error);
                showAlert('Error deleting product', 'error');
            }
        }

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `fixed top-4 right-4 px-4 py-2 rounded ${
        type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'
    }`;
            alertDiv.textContent = message;
            document.body.appendChild(alertDiv);
            setTimeout(() => alertDiv.remove(), 3000);
        }
    </script>
@endsection
