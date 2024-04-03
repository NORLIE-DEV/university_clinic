@extends('layout.landingpage_layout')

@section('content')
    <div class="w-full flex bg-[#D3E7F7]" style="height: 100vh;">
        <div class="justify-items-center" style="width: 50%; height:100">

            <div class="mt-20 ml-2 p-5 flex items-center gap-10">
                <div class="w-24 h-0.5 bg-blue-900"></div>
                <div class="flex items-center gap-3 font-medium">
                    <img src="{{ asset('asset/img/logo/image_2024-04-02_023118891-removebg-preview.png') }}" class="w-10"
                        alt="">
                    <img src="https://upload.wikimedia.org/wikipedia/en/d/d1/Seal_of_University_of_Nueva_Caceres.png"
                        class="w-10" alt="">
                    <h4 class="text-xl text-blue-900">UNIVERSITY OF NUEVA CACERES CLINIC</h4>
                </div>

            </div>
            <div class="p-10 items-center gap-10 font-black">
                <h1 class="text-6xl text-[#102039] leading-snug">WE CARE ABOUT YOUR <span
                        class="text-blue-950">HEALTH</span>
                </h1>
            </div>
            <div class="ml-10">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea, nihil ullam animi delectus tenetur, iure at
                    illum autem id iste aspernatur atque quae magni non?</p>
            </div>
            <div class="m-10 bg-blue-600 w-40 p-3 rounded-md hover:bg-blue-900 duration-700">
                <a href="/patient_login">
                    <button class="text-white text-center">Appointment <span class="ml-3"><i
                                class="fa-solid fa-arrow-right"></i></span></button>
                </a>
            </div>
        </div>
        <div class="justify-items-center" style="width: 50%; height:100">
            <div class="mt-24">
                <img src="{{ asset('asset/img/logo/doctors-reading-data-digital-tablet.png') }}" alt="">
            </div>
        </div>
    </div>
    {{-- about --}}
    <div class="flex w-full h-auto">
        <div class="w-1/2">
            <div class="mt-20 ml-2 p-5 flex items-center gap-10">
                <div class="w-24 h-0.5 bg-blue-900"></div>
                <div class="flex items-center gap-3 ">
                    <img src="{{ asset('asset/img/logo/image_2024-04-02_023118891-removebg-preview.png') }}" class="w-10"
                        alt="">
                    <h4 class="text-xl text-blue-900 font-medium">ABOUT UNC CLINIC</h4>
                </div>
            </div>
            <div class="ml-10">
                <h1 class="text-4xl font-bold" class="text-[#102039]">Welcome To Our Clinic</h1>
                <div class="mt-10">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, nesciunt distinctio tenetur sequi
                        magni suscipit minus dolor incidunt eaque nemo ipsa sed mollitia, debitis praesentium commodi! Natus
                        enim quidem tempora voluptatem! Adipisci, quibusdam. Rerum est molestias tempora? Minus optio soluta
                        aliquam, ratione facere repellat nisi veniam dolore nostrum quia ipsum dolorem rerum impedit! Quod
                        ea, earum hic adipisci modi ad repudiandae consequatur dolore nobis sed doloribus. Blanditiis vitae
                        magnam rem ut perspiciatis. Ratione, veniam quaerat.</p>
                </div>
            </div>
            <div class="m-10 bg-blue-600 w-40 p-3 rounded-md hover:bg-blue-900 duration-700">
                <a href="#">
                    <button class="text-white text-center">Appointment <span class="ml-3"><i
                                class="fa-solid fa-arrow-right"></i></span></button>
                </a>
            </div>
            <div class="m-10 bg-gray-600 w-40 p-3 rounded-md hover:bg-gray-700 duration-700">
                <a href="#">
                    <button class="text-white text-center">Find Doctor <span class="ml-3"><i
                                class="fa-solid fa-arrow-right"></i></span></button>
                </a>
            </div>
        </div>
        <div class="w-1/2 h-auto"">
            <img src="{{ asset('asset/img/logo/desktop-wallpaper-doctor-png.png') }}" alt="">
        </div>
    </div>

    {{-- departments --}}
    <div class="bg-blue-950 pb-10">
        <div class="mt-20 ml-2 p-5 flex justify-center items-center gap-10">
            <div class="w-24 h-0.5 bg-white"></div>
            <div class="flex items-center gap-3 ">
                <h4 class="text-xl text-white font-medium">OUR DEPARTMENTS</h4>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-5xl text-[#ffffff] font-bold">Our Medical Services</h1>
        </div>
        <div class="ml-5 mt-24 flex gap-10 justify-center mb-10">
            <div class="w-36 h-28 bg-[#28BDF3] flex items-center justify-center rounded-xl shadow-2xl text-white">
                <div class="text-center">
                    <i class="fa-solid fa-tooth text-5xl"></i><br>
                    <p class="mt-1">Dentistry</p>
                </div>
            </div>
            <div class="w-36 h-28 bg-[#28BDF3] flex items-center justify-center rounded-xl shadow-2xl text-white">
                <div class="text-center">
                    <i class="fa-solid fa-tooth text-5xl"></i><br>
                    <p class="mt-1">Consultation</p>
                </div>
            </div>
            <div class="w-36 h-28 bg-[#28BDF3] flex items-center justify-center rounded-xl shadow-2xl text-white">
                <div class="text-center">
                    <i class="fa-solid fa-tooth text-5xl"></i><br>
                    <p class="mt-1">Counseling</p>
                </div>
            </div>
            <div class="w-36 h-28 bg-[#28BDF3] flex items-center justify-center rounded-xl shadow-2xl text-white">
                <div class="text-center">
                    <i class="fa-solid fa-tooth text-5xl"></i><br>
                    <p class="mt-1">Appointments</p>
                </div>
            </div>
            <div class="w-36 h-28 bg-[#28BDF3] flex items-center justify-center rounded-xl shadow-2xl text-white">
                <div class="text-center">
                    <i class="fa-solid fa-tooth text-5xl"></i><br>
                    <p class="mt-1">Check Ups</p>
                </div>
            </div>
        </div>

    </div>

    <div>
        <div class="mt-24 ml-2 p-5 flex justify-center items-center gap-10">
            <div class="w-24 h-0.5 bg-blue-900"></div>
            <div class="flex items-center gap-3 ">
                <h4 class="text-xl text-blue-900 font-medium">OUR DOCTORS</h4>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-5xl text-[#102039] font-bold">Our Specialist</h1>
        </div>
        <div class="flex gap-10 justify-center m-10">
            <div class="" style="width:30%; height:auto;">
                <img src="https://thumbs.dreamstime.com/b/confident-doctor-over-white-background-portrait-male-standing-vertical-shot-39366393.jpg"
                    alt="" class="h-96 m-auto">
                <div class="p-4 ml-4 text-[#102039] hover:bg-blue-700 hover:text-white duration-700">
                    <h3 class="text-2xl p-2 font-medium">Dr. John Doe</h3>
                    <h6 class="p-2">Dentist</h6>
                    <div class="flex justify-left m-2 gap-3 items-center">
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-facebook"></i>
                        </div>
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="" style="width:30%; height:auto;">
                <img src="https://previews.123rf.com/images/leungchopan/leungchopan1502/leungchopan150203512/36470930-woman-doctor-portrait.jpg"
                    alt="" class="h-96 m-auto">
                <div class="p-4 ml-4 text-[#102039] hover:bg-blue-700 hover:text-white duration-700">
                    <h3 class="text-2xl p-2 font-medium">Dr. Michelle Ong</h3>
                    <h6 class="p-2">Dentist</h6>
                    <div class="flex justify-left m-2 gap-3 items-center">
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-facebook"></i>
                        </div>
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="" style="width:30%; height:auto;">
                <img src="https://i.pinimg.com/736x/b9/97/a5/b997a530822d0f2c03259070d4590d45.jpg" alt=""
                    class="h-96 m-auto">
                <div class="p-4 ml-4 text-[#102039] hover:bg-blue-700 hover:text-white duration-700">
                    <h3 class="text-2xl p-2 font-medium">Dr. Jane Lee</h3>
                    <h6 class="p-2">Dentist</h6>
                    <div class="flex justify-left m-2 gap-3 items-center">
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-facebook"></i>
                        </div>
                        <div class="w-10 h-10 rounded-full border  flex justify-center items-center">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div>
        <div class="mt-20 ml-2 p-5 flex justify-center items-center gap-10">
            <div class="w-24 h-0.5 bg-blue-900"></div>
            <div class="flex items-center gap-3 ">
                <h4 class="text-xl text-blue-900 font-medium">OUR GALLERY</h4>
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-5xl text-[#102039] font-bold">Our Medical Camp</h1>
        </div>
        <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-24">
            <div class="-m-1 flex flex-wrap md:-m-2">
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://media.istockphoto.com/id/1344413214/photo/doctor-listening-to-little-boys-heart.jpg?s=612x612&w=0&k=20&c=3YVwTwHLNAxQ0AF-MTf_PLwgpxIzSPe2r0EgjBFnAbo=" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://media.istockphoto.com/id/132264568/photo/toddler-girl-laughing-while-doctor-examines.jpg?s=612x612&w=0&k=20&c=b84YBJUhyBoh3jMhIJkPImsPilN02Qy-mEQl6qG_ddw=" />
                    </div>
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX-4gfh9GXR7kzeBLVxoENMsM7f-Pqy7b_WQ&usqp=CAU" />
                    </div>
                </div>
                <div class="flex w-1/2 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://www.shutterstock.com/image-photo/doctor-talking-patient-office-260nw-741583993.jpg" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://www.shutterstock.com/shutterstock/videos/1071803008/thumb/10.jpg?ip=x480" />
                    </div>
                    <div class="w-1/2 p-1 md:p-2">
                        <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                            src="https://www.shutterstock.com/image-photo/shot-beautiful-female-doctor-talking-600nw-2323157019.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- footer --}}

@endsection
