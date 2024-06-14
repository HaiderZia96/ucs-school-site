<div class="accordion accordion-flush mb-3 mx-2 mx-sm-0" id="accordionAbout">
    <div class="accordion-item mb-2">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                Admission
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
             data-bs-parent="#accordionAbout">
            <div class="accordion-body">
                <ul class="px-0">
                    <li><a href="{{route('admission')}}"><strong>Admission Process</strong></a></li>
                    <li><a href="{{route('admission')}}"><strong>Admission Office</strong></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="accordion-item mb-2">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                About the School
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
             data-bs-parent="#accordionAbout">
            <div class="accordion-body">
                <ul class="px-0">
                    <li><a href="{{route('about')}}"><strong>Accrediation</strong></a></li>
                    <li><a href="{{route('about')}}"><strong>Mission and Vision</strong></a></li>
                </ul>
            </div>
        </div>
    </div>
{{--    <div class="accordion-item mb-2">--}}
{{--        <h2 class="accordion-header" id="headingThree">--}}
{{--            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"--}}
{{--                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">--}}
{{--                Jobs--}}
{{--            </button>--}}
{{--        </h2>--}}
{{--        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"--}}
{{--             data-bs-parent="#accordionAbout">--}}
{{--            <div class="accordion-body">--}}
{{--                <ul class="px-0">--}}
{{--                    <li><a href="http://localhost/ucscareer/public/"><strong>Accountant</strong></a></li>--}}
{{--                    <li><a href="http://localhost/ucscareer/public/"><strong>Math Teacher</strong></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="accordion-item mb-2">--}}
{{--        <h2 class="accordion-header" id="headingFour">--}}
{{--            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"--}}
{{--                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">--}}
{{--                Upcoming Events--}}
{{--            </button>--}}
{{--        </h2>--}}
{{--        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"--}}
{{--             data-bs-parent="#accordionAbout">--}}
{{--            <div class="accordion-body">--}}
{{--                <ul class="px-0">--}}
{{--                    <li><a href="{{route('news-and-events')}}"><strong>eLEARNING</strong></a></li>--}}
{{--                    <li><a href="{{route('news-and-events')}}"><strong>How to use the Platform for Students</strong></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>
