@extends('desaindashboard.slicing.app')
@section('customScript1')
  <script src="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css"></script>
@endsection
@section('content')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="px-0 mx-4 shadow-none navbar navbar-main navbar-expand-lg border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="px-3 py-1 container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="px-0 pt-1 pb-0 mb-0 bg-transparent breadcrumb me-sm-6 me-5">
            <li class="text-sm breadcrumb-item"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="text-sm breadcrumb-item text-dark active" aria-current="page">Tables</li>
          </ol>
          <h6 class="mb-0 font-weight-bolder">Tables</h6>
        </nav>
        <div class="mt-2 collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a class="mb-0 btn btn-outline-primary btn-sm me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-soft-ui-dashboard">Online Builder</a>
            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="px-0 nav-link text-body font-weight-bold">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="p-0 nav-link text-body" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="px-3 nav-item d-flex align-items-center">
              <a href="javascript:;" class="p-0 nav-link text-body">
                <i class="cursor-pointer fa fa-cog fixed-plugin-button-nav"></i>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="p-0 nav-link text-body" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="cursor-pointer fa fa-bell"></i>
              </a>
              <ul class="px-2 py-3 dropdown-menu dropdown-menu-end me-sm-n4" aria-labelledby="dropdownMenuButton">
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="py-1 d-flex">
                      <div class="my-auto">
                        <img src="{{url('creative-tim/assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-1 text-sm font-weight-normal">
                          <span class="font-weight-bold">New message</span> from Laur
                        </h6>
                        <p class="mb-0 text-xs text-secondary ">
                          <i class="fa fa-clock me-1"></i>
                          13 minutes ago
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li class="mb-2">
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="py-1 d-flex">
                      <div class="my-auto">
                        <img src="{{url('creative-tim/assets/img/small-logos/logo-spotify.svg')}}" class="avatar avatar-sm bg-gradient-dark me-3 ">
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-1 text-sm font-weight-normal">
                          <span class="font-weight-bold">New album</span> by Travis Scott
                        </h6>
                        <p class="mb-0 text-xs text-secondary ">
                          <i class="fa fa-clock me-1"></i>
                          1 day
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="py-1 d-flex">
                      <div class="my-auto avatar avatar-sm bg-gradient-secondary me-3">
                        <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <title>credit-card</title>
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                              <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(453.000000, 454.000000)">
                                  <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                  <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-1 text-sm font-weight-normal">
                          Payment successfully completed
                        </h6>
                        <p class="mb-0 text-xs text-secondary ">
                          <i class="fa fa-clock me-1"></i>
                          2 days
                        </p>
                      </div>
                    </div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="py-4 container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="mb-4 card">
            <div class="pb-0 card-header">
              <h6>Authors table</h6>
            </div>
            <div class="px-0 pt-0 pb-2 card-body">
              <div class="p-0 table-responsive">
                <table class="table mb-0 align-items-center display" id="example" >
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">John Michael</h6>
                            <p class="mb-0 text-xs text-secondary">john@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Manager</p>
                        <p class="mb-0 text-xs text-secondary">Organization</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">23/04/18</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-3.jpg')}}" class="avatar avatar-sm me-3" alt="user2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Alexa Liras</h6>
                            <p class="mb-0 text-xs text-secondary">alexa@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Programator</p>
                        <p class="mb-0 text-xs text-secondary">Developer</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">11/01/19</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-4.jpg')}}" class="avatar avatar-sm me-3" alt="user3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Laurent Perrier</h6>
                            <p class="mb-0 text-xs text-secondary">laurent@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Executive</p>
                        <p class="mb-0 text-xs text-secondary">Projects</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">19/09/17</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-3.jpg')}}" class="avatar avatar-sm me-3" alt="user4">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Michael Levi</h6>
                            <p class="mb-0 text-xs text-secondary">michael@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Programator</p>
                        <p class="mb-0 text-xs text-secondary">Developer</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-success">Online</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">24/12/08</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-2.jpg')}}" class="avatar avatar-sm me-3" alt="user5">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Richard Gran</h6>
                            <p class="mb-0 text-xs text-secondary">richard@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Manager</p>
                        <p class="mb-0 text-xs text-secondary">Executive</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">04/10/21</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 py-1 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/team-4.jpg')}}" class="avatar avatar-sm me-3" alt="user6">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Miriam Eric</h6>
                            <p class="mb-0 text-xs text-secondary">miriam@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-xs font-weight-bold">Programtor</p>
                        <p class="mb-0 text-xs text-secondary">Developer</p>
                      </td>
                      <td class="text-sm text-center align-middle">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="text-center align-middle">
                        <span class="text-xs text-secondary font-weight-bold">14/09/20</span>
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-xs text-secondary font-weight-bold" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="mb-4 card">
            <div class="pb-0 card-header">
              <h6>Projects table</h6>
            </div>
            <div class="px-0 pt-0 pb-2 card-body">
              <div class="p-0 table-responsive">
                <table class="table mb-0 align-items-center justify-content-center">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Budget</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Completion</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-spotify.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Spotify</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$2,500</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-invision.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="invision">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Invision</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$5,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary" aria-haspopup="true" aria-expanded="false">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-jira.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="jira">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Jira</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$3,400</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">30%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary" aria-haspopup="true" aria-expanded="false">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-slack.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="slack">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Slack</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$1,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">0%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary" aria-haspopup="true" aria-expanded="false">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-webdev.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="webdev">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Webdev</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$14,000</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">80%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary" aria-haspopup="true" aria-expanded="false">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="px-2 d-flex">
                          <div>
                            <img src="{{url('creative-tim/assets/img/small-logos/logo-xd.svg')}}" class="avatar avatar-sm rounded-circle me-2" alt="xd">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Adobe XD</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="mb-0 text-sm font-weight-bold">$2,300</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="text-center align-middle">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="text-xs me-2 font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="mb-0 btn btn-link text-secondary" aria-haspopup="true" aria-expanded="false">
                          <i class="text-xs fa fa-ellipsis-v"></i>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="pt-3 footer ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="mb-4 col-lg-6 mb-lg-0">
              <div class="text-sm text-center copyright text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
@endsection
@section('customScript2')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script>
  new DataTable('#example', {
    columnDefs: [
        {
            targets: [0],
            orderData: [0, 1]
        },
        {
            targets: [1],
            orderData: [1, 0]
        },
        {
            targets: [4],
            orderData: [4, 0]
        }
    ]
});
</script>
@endsection