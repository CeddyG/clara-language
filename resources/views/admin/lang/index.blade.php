@extends('admin.dashboard')

@section('CSS')    
    <!-- YesNoBtn -->
    {!! Html::style('adminlte/css/alt/yesno-btn.css') !!}
@stop

@section('content')

    @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
    @endif
    
    <div class="row">
        <div class="col-sm-5">
            <br>
            <div class="box box-info">	
                <div class="box-header with-border">
                    {{ __('clara-lang::lang.activate') }}
                </div>
                <div class="box-body"> 
                    <div class="col-sm-12">
                        {!! BootForm::open()->action(route('admin.lang.store'))->post() !!}
                        
                        @foreach ($aLangs as $sLang)
                            {!! BootForm::YesNo(__('clara-lang::code.'.$sLang), $sLang) !!}
                        @endforeach
                        
                        {!! BootForm::submit(__('clara::general.send'), 'btn-primary')->addClass('pull-right') !!}
                        
                        {!! BootForm::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JS')
    
@endsection
