@extends('layouts.app')

@section('content')
<template>
<br>
<br>
<br>
<br>
<br>
<br>

<div class="col-md-5 col-md-offset-4">

    <div class="panel-body elevation-12">
        <v-toolbar dark color="blue lighten-1">
            <v-toolbar-title>Login</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <hr>
        <form action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                <v-text-field autofocus value="{{ old('email') }}" name="email" type="email" placeholder="Ingresa  tu email"></v-text-field>
                {!! $errors->first('email','<span class="help-block">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">

                <v-text-field 
                name="password" type="password" placeholder="Ingresa tu Contraseña"></v-text-field>
                {!! $errors->first('password','<span class="help-block">:message</span>') !!}
            </div>

            <v-btn type="submit" color="deep-orange darken-4
                    " black dark btn btn-sm block>Acceder</v-btn>

        </form>

    </div>
</div>

</div>
</template>
@endsection