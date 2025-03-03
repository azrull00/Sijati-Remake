<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiJati Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #f8f9fa;
            padding: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover,
        .sidebar .active {
            background: #e0e0e0;
        }
    </style>
</head>


<body>
    <div class="d-flex">
        <div class="sidebar">
            <h4>Si Jati</h4>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

            <a href="#" class="mt-3">Product</a>
            <a href="{{ route('dashboard.products.produk') }}"
                class="ms-3 {{ request()->routeIs('dashboard.products') ? 'active' : '' }}">Produk</a>
            <a href="#" class="ms-3">Bahan</a>

            <a href="#manufacturingMenu" data-bs-toggle="collapse" class="mt-3 d-block">Manufacturing</a>
            <div id="manufacturingMenu" class="collapse {{ request()->is('dashboard/manufacturing*') ? 'show' : '' }}">
                <a href="{{ route('dashboard.manufacturing') }}"
                    class="ms-3 {{ request()->routeIs('dashboard.manufacturing') ? 'active' : '' }}">Overview</a>
                <a href="{{ route('dashboard.manufacturing.vendor') }}"
                    class="ms-3 {{ request()->routeIs('dashboard.manufacturing.vendor') ? 'active' : '' }}">Vendor</a>
                <a href="{{ route('dashboard.manufacturing.bill_of_materials') }}"
                    class="ms-3 {{ request()->routeIs('dashboard.manufacturing.bill_of_materials') ? 'active' : '' }}">Bill
                    of Materials</a>
            </div>

            <a href="{{ route('dashboard.purchasing') }}"
                class="mt-3 {{ request()->routeIs('dashboard.purchasing') ? 'active' : '' }}">Purchasing</a>
            <a href="{{ route('dashboard.sales') }}"
                class="mt-3 {{ request()->routeIs('dashboard.sales') ? 'active' : '' }}">Sales</a>
        </div>


        <div class="content p-4" style="margin-left: 250px; width: 100%;">
            @yield('content')
        </div>
    </div>
</body>

</html>
