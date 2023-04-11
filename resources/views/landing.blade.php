@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">Drug Abuse in Malaysia</h1>
    <hr class="my-4">
    <p class="lead">Learn about the latest statistics on drug abuse in Malaysia and the different types of drugs that
        are commonly abused.</p>
    <a class="btn btn-primary btn-lg" href="#statistics" role="button">View Statistics</a>
    <a class="btn btn-secondary btn-lg" href="#drug-types" role="button">View Drug Types</a>
</div>

<div class="container my-5" id="statistics">
    <h2>Current Malaysia Statistics</h2>
    <hr class="my-4">
    <p>According to the National Anti-Drug Agency (NADA), there were a total of 20,313 drug addicts in Malaysia in 2020.
        The majority of these addicts were male (95.3%) and aged between 19 and 39 years old.</p>
    <p>The most commonly abused drugs in Malaysia are methamphetamine (also known as syabu), heroin, and cannabis.</p>
</div>

<div class="container my-5" id="drug-types">
    <h2>Types of Drugs</h2>
    <hr class="my-4">
    <p>There are many different types of drugs that are abused in Malaysia, including:</p>
    <ul>
        <li>Methamphetamine (syabu)</li>
        <li>Heroin</li>
        <li>Cannabis (marijuana)</li>
        <li>Cocaine</li>
        <li>Ecstasy (MDMA)</li>
    </ul>
</div>

<div class="container my-5">
    <h2>Contact Us</h2>
    <hr class="my-4">
    <p>If you or someone you know is struggling with drug addiction, please contact us for help.</p>
    <p>Phone: 03-8911-2200</p>
    <p>Email: webmaster@adk.gov.my</p>
</div>
@endsection