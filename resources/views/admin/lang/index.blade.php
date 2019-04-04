@extends('admin.dashboard')

@section('CSS')    
    <!-- YesNoBtn -->
    {!! Html::style('adminlte/css/alt/yesno-btn.css') !!}
    
    <style>
        .affix
        {
            width: 13%;
            top: 0;
        }
    </style>
@stop

@section('content')

    @if(session()->has('ok'))
        <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
    @endif
    
    {!! BootForm::open()->action(route('admin.lang.store'))->post() !!}
    {!! BootForm::bind($aActiveLangs) !!}
        <div class="row">
            <div class="col-sm-5">
                <br>
                <div class="box box-info">	
                    <div class="box-header with-border">
                        {{ __('clara-lang::lang.activate') }}
                    </div>
                    <div class="box-body"> 
                        <div class="col-sm-12">

                            @foreach ($aActiveLangs as $sLang => $iValue)
                                {!! BootForm::YesNo(__('clara-lang::code.'.$sLang), $sLang) !!}
                            @endforeach

                            @foreach ($aLangs as $sLang)
                                @if (!array_key_exists ($sLang, $aActiveLangs))
                                    {!! BootForm::YesNo(__('clara-lang::code.'.$sLang), $sLang) !!}
                                @endif
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div data-spy="affix" data-offset-top="195">
                    <br>
                    <div class="box box-info">	
                        <div class="box-header with-border">
                            {{ __('clara::general.save') }}
                        </div>
                        <div class="box-body"> 
                            <div class="col-sm-12">
                                {!! BootForm::submit(__('clara::general.send'), 'btn-primary')->addClass('pull-right') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! BootForm::close() !!}

@endsection

@section('JS')
    
@endsection
