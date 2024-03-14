<nav
    id="sidebarMenu"
    class="sidebar d-lg-block bg-gray-800 text-white collapse"
    data-simplebar
>
    <div class="sidebar-inner px-4 pt-3">
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a
                    href="../../index.html"
                    class="nav-link d-flex align-items-center"
                >
                    <span class="sidebar-icon">
                        <img
                            src="{{
                                asset('assets/img/logo-smk-ibnu-sina.png')
                            }}"
                            height="50"
                            width="50"
                            alt="Volt Logo"
                        />
                    </span>
                    <span
                        class="mt-1 ms-1 bold fw-bold text-success sidebar-text"
                        >SMK IBNU SINA</span
                    >
                </a>
            </li>
            <li
                class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}"
            >
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <svg
                            class="icon icon-xs me-2"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"
                            ></path>
                            <path
                                d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"
                            ></path>
                        </svg>
                    </span>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <span
                    class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    data-bs-target="#submenu-outdated-inventories"
                >
                    <span>
                        <span class="sidebar-icon">
                            <i class="ri-archive-stack-fill"></i>
                        </span>
                        <span class="sidebar-text">Outdated Inventories</span>
                    </span>
                    <span class="link-arrow">
                        <svg
                            class="icon icon-sm"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </span>
                </span>
                <div
                    class="multi-level collapse"
                    role="list"
                    id="submenu-outdated-inventories"
                    aria-expanded="false"
                >
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('data-outdated-computers.index') }}">
                                <span class="sidebar-text"
                                    >Outdated Computers</span
                                >
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('data-outdated-supporting-device.index') }}">
                                <span class="sidebar-text"
                                    >Outdated Support...</span
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <span
                    class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    data-bs-target="#submenu-laboratory-inventories"
                >
                    <span>
                        <span class="sidebar-icon">
                            <i class="ri-archive-stack-fill"></i>
                        </span>
                        <span class="sidebar-text">Laboratory Inven...</span>
                    </span>
                    <span class="link-arrow">
                        <svg
                            class="icon icon-sm"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </span>
                </span>
                <div
                    class="multi-level collapse"
                    role="list"
                    id="submenu-laboratory-inventories"
                    aria-expanded="false"
                >
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laboratory-computers.index') }}">
                                <span class="sidebar-text"
                                    >Laboratory Computer</span
                                >
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laboratory-supporting-devices.index') }}">
                                <span class="sidebar-text"
                                    >Laboratory Support...</span
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <span
                    class="nav-link collapsed d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    data-bs-target="#submenu-inventories"
                >
                    <span>
                        <span class="sidebar-icon">
                            <i class="ri-database-2-fill"></i>
                        </span>
                        <span class="sidebar-text">Data Inventories</span>
                    </span>
                    <span class="link-arrow">
                        <svg
                            class="icon icon-sm"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </span>
                </span>
                <div
                    class="multi-level collapse"
                    role="list"
                    id="submenu-inventories"
                    aria-expanded="false"
                >
                    <ul class="flex-column nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('data-computers.index') }}">
                                <span class="sidebar-text">Data Computers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('data-supporting-devices.index') }}">
                                <span class="sidebar-text"
                                    >Data Supporting De...</span
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li
                class="nav-item {{ Request::is('laboratory-rooms*') ? 'active' : '' }}"
            >
                <a
                    href="{{ route('laboratory-rooms.index') }}"
                    class="nav-link"
                >
                    <span class="sidebar-icon">
                        <i class="ri-home-office-fill"></i>
                    </span>
                    <span class="sidebar-text">Laboratory Rooms</span>
                </a>
            </li>

            <li
                role="separator"
                class="dropdown-divider mt-4 mb-3 border-gray-700"
            ></li>

            <li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="ri-user-3-fill"></i>
                    </span>
                    <span class="sidebar-text">User</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('roles*') ? 'active' : '' }}">
                <a href="{{ route('roles.index') }}" class="nav-link">
                    <span class="sidebar-icon">
                        <i class="ri-user-3-fill"></i>
                    </span>
                    <span class="sidebar-text">Roles</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
