@extends('layouts.master')

@section('content')
    <div class="col-lg-2 col-xs-12">
        <form>
            <div class="input-group mb-3">
                <select class="form-control form-select" aria-label="Team Count" aria-describedby="button-rebuild">
                    <option selected value="4">4</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                    <option value="20">20</option>
                </select>
                <button class="btn btn-outline-success" type="button" id="button-rebuild">Rebuild</button>
            </div>
        </form>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link show active" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-standings" role="tab" aria-controls="nav-contact" aria-selected="false">Standings</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-fixtures" role="tab" aria-controls="nav-profile" aria-selected="false">Fixtures</a>
            <a class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-results" role="tab" aria-controls="nav-contact" aria-selected="false">Results</a>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-standings" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
                <div class="col">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Team</th>
                            <th scope="col">Goals</th>
                            <th scope="col">Points</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>10-5</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>10-8</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Otto</td>
                            <td>10-5</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Thornton</td>
                            <td>10-8</td>
                            <td>2</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-fixtures" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
                <div class="col">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="my-0 fw-normal">
                                Round 2
                                <button type="button" class="btn btn-outline-primary float-right btn-sm ml-10">Play All</button>
                                <button type="button" class="btn btn-outline-success float-right btn-sm">Play</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>-</td>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>-</td>
                                    <td>Thornton</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="my-0 fw-normal">Round 3</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>-</td>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>-</td>
                                    <td>Thornton</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="my-0 fw-normal">Round 4</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>-</td>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>-</td>
                                    <td>Thornton</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-results" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
                <div class="col">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h5 class="my-0 fw-normal">Round 1</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>2-1</td>
                                    <td>Otto</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>1-1</td>
                                    <td>Thornton</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
