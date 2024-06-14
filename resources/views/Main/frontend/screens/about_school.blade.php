@section('title', 'University Cambridge School | UCS Faisalabad | UCSF History')
@section('description', 'The University Cambridge School Faisalabad has a dynamic atmosphere that promotes the development of critical and disciplined thinkers inspired by the joy of learning. Read more!')
@section('keywords', 'University Cambridge School, UCS Faisalabad, UCSF History')

@extends('Main.frontend.web')
@section('content')
    <div class="about-wrapper mt-sm-5 mt-3">
        <div class="container g-0">
            <div class="row g-0">
                <h3 class="about-us px-2 px-sm-0">Salient Academic Features</h3>
                <div class="col-md-5">
                    <div class="about-para mx-2 mx-sm-0">
                        <h4 class="px-2 px-sm-0 mt-3">The School</h4>
                        <ul>
                            <li> Has a dynamic atmosphere that promotes the development of critical and disciplined
                                thinkers who are inspired by the joy of learning.
                            </li>
                            <li>Believes that teachers are highly trained professionals who are in a
                                position of trust and who are bound by moral and ethical obligations.
                            </li>
                            <li>
                                Believes that parents are the first teachers of the child and that mother
                                and father must play an integral role within the school.
                            </li>
                            <li>
                                Promotes ethical and compassionate behavior in all as we share
                                knowledge and begin to acquire wisdom in a climate of trust and hope.
                            </li>
                            <li>
                                Seeks to develop the potential of the human mind by attending to the
                                physical, intellectual, social and emotional development of students.
                            </li>
                            <li>
                                Believes that the strength of character necessary for co-operation and
                                collaboration comes from self-confidence and high self-esteem.
                            </li>
                        </ul>
                        <h4 class="px-2 px-sm-0 mt-3">School Curriculum</h4>
                        <p>
                            The curriculum of the school refers to the many activities designed to
                            promote the intellectual, social, physical and personal development of its
                            pupils. In addition to the formal teaching sessions in a day, it includes the
                            'hidden' curriculum, the relationships and values evident at school.
                            Text books are available at book shop specified by the School
                        </p>
                        <h4 class="px-2 px-sm-0 mt-3">A Quality EducationUCS believes in bringing cost effective quality
                            education which is achieved By:</h4>
                        <ul>
                            <li>Planning</li>
                            <li>Teaching</li>
                            <li>Testing and Feedback</li>
                        </ul>
                        <h4 class="px-2 px-sm-0 mt-3">Planning</h4>
                        <p>
                            Weekly detailed plans for each subject are prepared; including all the topics
                            to be taught and all the points to be explained. Each plan represents
                            complete aims and objectives of the topic and is designed to complete in a
                            specific time. It is followed by activities and is merged into following
                            themes.
                        </p>
                        <h4 class="px-2 px-sm-0 mt-3">Teaching Methods</h4>
                        <p>
                            Flexible and accommodating teaching strategies are used that cater for
                            different ability levels. Students centered learning is encouraged. At the
                            same time they are encouraged in creativity, foster collaboration and peer
                            learning. Teachers are passionate about their subjects and teaching style.
                            Subject matter is demonstrated with confidence that is reflected in their
                            energy, enthusiasm and in the diversity of their teaching methods.
                        </p>

                    </div>
                    <div class="enrollment my-4">
                        <div class="container">
                            <div class="d-flex">
                                <img src="{{asset('Main/frontend/images/ucs_logo.png')}}" class="img-fluid">
                                <div class="d-inline ms-sm-3 mt-3">
                                    <h4 class="mb-0">Enrollment for class 2023/24 is underway!</h4>
                                    <div class="d-flex">
                                        <a href="#">Click here to register</a>
                                        <i class="fa fa-forward ms-2 mt-2" aria-hidden="true" style="color: red"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="cambridge-banner mx-sm-3 my-2 my-md-0">
                        <img src="{{asset('Main/frontend/images/truely_different/admission_flyer.jpg')}}" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="News">
                        <h3 class="widget-title">News &amp; Updates</h3>
                        <ul class="px-2">
                            <li class="ps-0 py-2">
                                @foreach($newsEventsAbout as $newsEvents)
                                    <div class="d-flex">
                                        <a href="{{route('news-and-events-detail',$newsEvents->slug)}}" target="_blank"
                                           class="blog-img">
                                            <img
                                                src="{{asset('Main/frontend/images/NewsAndEvents/' .$newsEvents->thumbnail )}}"
                                                alt="Image" class="single-blog-image pe-3">
                                        </a>
                                        <div class="d-inline ">
                                            <a href="{{route('news-and-events-detail',$newsEvents->slug)}}"
                                               class="mb-0">
                                                <span id="comp-under">{{ $newsEvents->short_description}}</span>
                                            </a>
                                            <p>{{$newsEvents->event_date}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </li>
                            {{-- <a href="#" target="blank">
                            Monsoon Plantation Drive
                            <img src="https://umdc.pk/front/images/blog/blog-1.jpg" class="py-2" alt="...">
                            </a>
                            <span>{{ $newsEvents->date }}</span> --}}

                            {{-- <li>
                                <a href="#" target="blank">
                                Seminar “Drug Abuse Prevention Among Youth”
                                <img src="https://umdc.pk/front/images/blog/blog-2.jpg" class="py-2" alt="...">
                                </a>
                                <span>30-Jun-2021</span>
                            </li>
                            <li>
                                <a href="#" target="blank">
                                Seminar on “World Blood Donor Day”
                                <img src="https://umdc.pk/front/images/blog/blog-3.jpg" class="py-2" alt="...">
                                </a>
                                <span>14-Jun-2021</span>
                            </li> --}}
                        </ul>
                    </div>
                    @include('Main.frontend.screens.accordion_right')

                    {{-- sign up form  --}}


                    <form class="about-signup mx-2 mx-sm-0 px-3 py-4" action="{{route('subscribe.store')}}"
                          method="POST">
                        @csrf
                        <p class="text-center"><b>Sign up for the “The right school for a bright future” newsletter for
                                free.</b></p>
                        <div class="mb-3 mt-3">
                            <label for="AboutEmail" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="AboutName" class="form-label">Your Name</label>
                            <input type="name" class="form-control" id="name" placeholder="Name" name="name">
                        </div>
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>

                    <div class="about-banner-group ">
                        <div class="image my-3">
                            <img src="{{asset('Main/frontend/images/enroll.jpg')}}" class="img-fluid px-5">
                        </div>
                        <div class="image-one my-3">
                            <img src="{{asset('Main/frontend/images/about-banner-one.png')}}" class="img-fluid px-5">
                        </div>
                        <div class="image-two my-3">
                            <img src="{{asset('Main/frontend/images/about-banner-two.png')}}" class="img-fluid px-5">
                        </div>
                        <div class="image-three my-3">
                            <img src="{{asset('Main/frontend/images/about-banner-three.png')}}" class="img-fluid px-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
