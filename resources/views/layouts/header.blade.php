<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">

                </div>
                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" fill="currentColor"
                                class="bi bi-bell" viewBox="0 0 16 16">
                                <path
                                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                            </svg>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                                <ul class="timeline">
                                    <li>
                                        <div class="timeline-panel">
                                            <div class="media me-2">
                                                <img alt="image" width="50"
                                                    src="{{ asset('assets') }}/images/avatar/1.jpg">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="mb-1">Dr sultads Send you Photo</h6>
                                                <small class="d-block">29 July 2020 - 02:26 PM</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </li>
                   
                    <li class="nav-item ps-3">
                        <div class="dropdown header-profile2">
                            <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="header-info2 d-flex align-items-center">
                                    <div class="header-media">
                                        <img src="{{ asset('assets/images/avatar/' . auth()->user()->image) }}"
                                            alt="">
                                    </div>
                                    <div class="header-info">
                                        <h6>{{ auth()->user()->name }}</h6>
                                        <p>{{ auth()->user()->nik }}</p>
                                    </div>

                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="card border-0 mb-0">
                                    <div class="card-header py-2">
                                        <div class="products">
                                            <img src="{{ asset('assets/images/avatar/' . auth()->user()->image) }}"
                                                class="avatar avatar-md" alt="">
                                            <div>
                                                <h6>{{ auth()->user()->name }}</h6>
                                                <span>{{ auth()->user()->nik }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 py-2">
                                        <a href="app-profile.html" class="dropdown-item ai-icon ">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9848 15.3462C8.11714 15.3462 4.81429 15.931 4.81429 18.2729C4.81429 20.6148 8.09619 21.2205 11.9848 21.2205C15.8524 21.2205 19.1543 20.6348 19.1543 18.2938C19.1543 15.9529 15.8733 15.3462 11.9848 15.3462Z"
                                                    stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M11.9848 12.0059C14.5229 12.0059 16.58 9.94779 16.58 7.40969C16.58 4.8716 14.5229 2.81445 11.9848 2.81445C9.44667 2.81445 7.38857 4.8716 7.38857 7.40969C7.38 9.93922 9.42381 11.9973 11.9524 12.0059H11.9848Z"
                                                    stroke="var(--primary)" stroke-width="1.42857"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>

                                            <span class="ms-2">Profile </span>
                                        </a>
                                        <a href="javascript:void(0);" class="dropdown-item ai-icon ">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z"
                                                    stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <circle cx="12.175" cy="11.889" r="2.63616"
                                                    stroke="var(--primary)" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>

                                            <span class="ms-2">Settings </span>
                                        </a>
                                        <form action="{{ url('logout/' . auth()->user()->id) }}" method="post" id="autoLogout">
                                            @csrf
                                        <a href="javascript:void(0);" role="button" class="dropdown-item ai-icon"  id="btnLog">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                viewBox="0 0 24 24" fill="none" stroke="var(--primary)"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                <polyline points="16 17 21 12 16 7"></polyline>
                                                <line x1="21" y1="12" x2="9" y2="12">
                                                </line>
                                            </svg>
                                            <span class="ms-2">Logout </span>
                                        </a>
                                        </form>
                                    </div>

                                </div>
                            </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<script>
     const formLog = document.querySelector('#autoLogout');
    document.querySelector("#btnLog").onclick = function() {
        Swal.fire({
            title: "Apakah Anda yakin ingin logout ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, logout !!"
        }).then((result) => {
            if (result.isConfirmed) {
                formLog.submit();
            }
        });
    };
</script>

<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            if (confirm('Are you sure?')) {

                document.getElementById('autoLogout').submit();
            }

        }
    });
</script>

<script>
    var logoutTimer;

    function startLogoutTimer() {
        logoutTimer = setTimeout(logout, 30 * 60 * 1000); // Mengatur timeout selama 29 menit (29 * 60 * 1000 ms)
    }

    function resetLogoutTimer() {
        clearTimeout(logoutTimer);
        startLogoutTimer();
    }

    function logout() {

        Swal.fire({
            title: 'Logout otomatis karena tidak ada aktivitas!',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
        setTimeout(function() {

            document.getElementById('autoLogout').submit();
        }, 15000);

    }

    // Event listener untuk mendeteksi aktivitas pengguna
    document.addEventListener('mousemove', resetLogoutTimer);
    document.addEventListener('keydown', resetLogoutTimer);
    document.addEventListener('click', resetLogoutTimer);
    document.addEventListener('scroll', resetLogoutTimer);

    // Memulai timer saat halaman dimuat
    startLogoutTimer();
</script>
