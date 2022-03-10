@extends('layouts.app')

@section ('content')
    <main class="container">
        <div class="row mt-5 mb-4">
            <!-- left main -->
            <div class="col-lg-6">
                <h1 class="display-2">{{ __('LOREM IPSUM?') }}</h1>
                <p class="paragraph">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque dolor non tempore dicta sed, facere aspernatur maxime velit sint quis vel, aperiam voluptate assumenda delectus voluptates et in molestiae distinctio? Exercitationem sunt incidunt velit error fugit nam, quas, similique cum a distinctio corrupti veniam libero ipsum explicabo at vitae accusamus quidem nesciunt accusantium earum. A obcaecati, impedit quidem maxime architecto tempore similique animi cupiditate.</p>
            </div>
            <!-- right main -->
            <div class="col-lg-5 my-5">

            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-lg-8">
                <button class="text-uppercase col-4 btn px-5 py-3 btn-primary rounded-pill">
                    <i class="fs-3 bi bi-compass"></i>
                    <span class="fs-4">{{ __('Explore') }}</span>
                </button>
                <span class="mx-3"></span>
                <button class="text-uppercase col-4 btn px-5 py-3 btn-secondary rounded-pill">
                <i class="fs-3 bi bi-pencil-square"></i>
                <span class="fs-4">{{ __('Request') }}</span>
                </button>
            </div>
        </div>
    </main>

    <section class="container">

        <div class="my-5">
        <span class="display-5 text-uppercase">
        <i class="bi bi-file-image"></i>
                Recent Search
                </span>
            <div class="d-flex mt-5">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
            </div>
</section>

            <div class="division dropdown-divider">

            </div>

            <section class="container my-5">
                <div class="text-center">
                    <span class="display-5 text-uppercase">
                    <i class="bi bi-brush"></i>
                    Popular Artists
                    </span>
                </div>
                <div class="row mt-5">
                    <div class="d-flex">
                    <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                        <div class="">
                            <a href="#" class="nav-link text-end text-dark fs-5">
                                <span>
                                    view more
                                    <i class="bi bi-arrow-right-circle"></i>
                                </span>
                            </a>
                    </div>
                    </div>
                </div>
            </section>



@endsection

