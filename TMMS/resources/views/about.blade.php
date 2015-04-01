@extends('app')
@section('navbar')
@if (Auth::check())
@section('sidebar')
@parent
@else
@section('main')
@section('guestcontent')
@endif
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">About</div>
            <div class="panel-body">
                The TMMS is an independent and self-contained web-based application. The aim of this application is to match an industry mentor with a senior student and a junior student of the UBC CS Tri-Mentoring Program by using the information provided by the participants themselves. This application provides features that allow emails to be sent to a specific subset of participants and features that can generate or update a participant’s report.
                <br><br>
                Mentoring programs similar to the Tri-Mentoring program exist in many different universities. It is likely that such a system already exists; however, these systems are not available to the general public, so there is no reference for the TMMS.
                <br><br>
                Produced by ByteMe
            </div>
        </div>
    </div>
</div>
@endsection