@extends('errors::minimal')

@section('title',$exception->getMessage()!=''? $exception->getMessage() : __('Not Found'))
@section('code', $exception->getMessage()!=''? $exception->getMessage() : '404')
@section('message', $exception->getMessage()!=''? __('Not Found'))
