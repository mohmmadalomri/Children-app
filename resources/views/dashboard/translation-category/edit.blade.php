@extends('dashboard');
@section('body')
    <section class="tooltip-validations" id="tooltip-validation">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">edite Tranlation Category</h2>
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate method="POST"
                              action="{{route('translation-category.update',$translationcategoy->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row g-1">
                                <div class="col-md-4 col-12 mb-3 position-relative">
                                    <label class="form-label" for="validationTooltip01">الاسم</label>
                                    <input type="text" class="form-control"  name="name" value="{{$translationcategoy->name}}" />
                                    <div class="valid-tooltip">Looks good!</div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
