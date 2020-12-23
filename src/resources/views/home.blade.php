@extends('layouts.master')

@section('content')
    <div id="app">
        <rebuild-fixture-component></rebuild-fixture-component>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link show active" id="nav-contact-tab" data-bs-toggle="tab" href="#nav-standings" role="tab" aria-controls="nav-contact" aria-selected="false">Standings</a>
                <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-fixtures" role="tab" aria-controls="nav-profile" aria-selected="false">Fixtures</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-standings" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
                    <div class="col">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Team</th>
                                <th scope="col">Goals</th>
                                <th scope="col">Points</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Mark</td>
                                <td>10-5</td>
                                <td>9</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-fixtures" role="tabpanel" aria-labelledby="nav-profile-tab">
                <fixture-list-component></fixture-list-component>
            </div>
        </div>
    </div>
@endsection
