@section('title', 'Contact us | Contact Number of UCSF | UCS Faisalabad Contact Number | UCSF Address')
@section('description', 'Parents are assured that their children will be supported and encouraged in all areas of their schooling at University Cambridge School. Contact us or apply online for admission details!')
@section('keywords', 'Contact us, Contact Number of UCSF, UCS Faisalabad Contact Number, UCSF Address')

@extends('Main.frontend.web')
@section('content')
<div class="contact-wrapper">
<div class="container g-0">
    <div class="row g-0">
        <h3 class="contact-head px-2 px-sm-0 pt-4 ">Contact Us</h3>
        <div class="col-md-6  px-3">
    <form  action="{{route('contacts.store')}}" class="contact-form  mt-4 pb-4 pt-2 mb-2" method="POST">
        @csrf
        <div class="mb-4 mt-3 px-2 px-0">
            <input type="text"  class="form-control" id="name" placeholder="Name" name="name">
        </div>
        <div class="mb-4 mt-3 px-2 px-0">
        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
        </div>
        <div class="mb-4 px-2  d-lg-flex num" >
            <input type="text" class="form-control"  id="number" placeholder="Phone Number" name="number" size="20" >
        </div>
        <div class="px-2 d-lg-flex">
            <textarea class="form-control" rows="4" id="message" placeholder="Enter Message" name="message"></textarea>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary send-btn  px-5 py-1 mt-4 mb-2" id="myBtn">Send</button>
        </div>
    </form>
</div>
    </div>
</div>
</div>
@endsection
