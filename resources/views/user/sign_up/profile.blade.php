<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/img/icon.svg">
    <link rel="stylesheet" href="/css/app.css?=<?php echo time();?>">
    <title>signup</title>
</head>
<body page-id="user-signup-profile" page-token="{{$token ?? ''}}">

<div class="container d-flex flex-column justify-content-center align-items-center h-100">
    <div class="container-header">
        <div class="logo d-flex  justify-content-center align-items-center ">
            <img style="height: 5rem " class="img-fluid preload-img" data-src="/img/logo.svg" alt="">
        </div>
        <p class="d-block">
            welcomme back <strong>{{$currentUser['name'] ?? ''}}</strong> , please complete your your profile.
        </p>
    </div>

    <form id="profile-form" class="profile-form flex-column d-flex justify-content-center align-items-center">
        <div  class="alert alert-dismissible  errors-messages w-100 d-none"  role="alert">
            <strong class="modal-error-title"></strong>
            <span class="modal-error-body"></span>
        </div>
        <div class="profile-form__header row shadow">

            <div class="d-flex justify-content-center row col-sm-12 col-md-4 left-side">
                <div class="card image-shower col-12 d-flex justify-content-center align-items-center">
                    <img id="image-preview" data-src="/img/unknown.png" class="shadow preload-img img-thumbnail" alt="">
                    <div class="custom-file shadow">
                        <input
                                type="file"
                                class="custom-file-input"
                                id="user-signup-photo"
                                accept="image/*"
                        >
                        <label class="custom-file-label" for="validatedCustomFile"></label>
                    </div>
                </div>
            </div>

            <div class="row col-sm-12  col-md-8 right-side">
                <div class="form-group form-group_up col-12 col-sm-6 ">
                    {{--  name  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                class="custom-form__control custom-form__control-input"
                                id="user-signup-name"
                                name="user-signup-name"

                                data-user="{{$currentUser['name'] ?? ''}}"
                                disabled>
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">FULL NAME</span>
                        </label>
                    </div>

                    {{--  gender  --}}
                    <div class="form-group__custom-control">
                        <select
                                id="user-signup-gender"
                                name="user-signup-gender"
                                class="custom-form__control custom-form__control-select"
                                required
                                data-parsley-required-message="sorry, you need to select gender. ">
                            <option value="" >gender</option>
                            <option selected value="male">male</option>
                            <option value="female">female</option>
                        </select>
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">GENDER</span>
                        </label>
                    </div>

                    {{--  adresse  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                class="custom-form__control custom-form__control-input"
                                id="user-signup-address"
                                name="user-signup-address"
                                data-user="fes 1050 miedlt"
                                required
                                data-parsley-pattern="/^[a-zA-Z\s\d]+$/"
                                data-parsley-required-message="sorry, you need to enter an address."
                                data-parsley-maxlength="150"
                                data-parsley-trigger="keyup">
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">ADDRESS</span>
                        </label>
                    </div>






                    {{--  role  --}}
                    <div class="form-group__custom-control">
                        <select
                                id="user-signup-role"
                                name="user-signup-role"
                                class="custom-form__control custom-form__control-select"
                                required
                                data-parsley-required-message="role is required.">
                            <option value="" >role</option>
                            <option selected value="developer web">developer web</option>
                            <option value="developer desktop">developer desktop</option>
                            <option value="chef project">chef project</option>
                            <option value="ui analysis">ui analysis</option>
                            <option value="designer">designer</option>

                        </select>
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">ROLE</span>
                        </label>
                    </div>

                    {{--  secret Question  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                id="user-signup-secretQuestion"
                                class="custom-form__control custom-form__control-input"
                                name="user-signup-secretQuestion"
                                required
                                data-user="how mush money you have"
                                data-parsley-required-message="sorry , this field is necessary, in case that you forget password you can reset your password with this option."
                        >
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">SECRET QUESTION</span>
                        </label>
                    </div>
                </div>
                <div class="form-group form-group_down col-12 col-sm-6">
                    {{--  date  --}}

                    <div class="form-group__custom-control">
                        <input
                                type="date"
                                class="custom-form__control custom-form__control-date"
                                id="user-signup-date"
                                name="user-signup-date"
                                required
                                data-user="09/04/1999"
                                data-parsley-required-message="date of birth is required."
                                data-parslet-trigger="change">
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">DATE OF BIRTH</span>
                        </label>
                    </div>

                    {{--  city  --}}
                    <div class="form-group__custom-control">
                        <select
                                id="user-signup-city"
                                name="user-signup-city"
                                class="custom-form__control custom-form__control-select mar-cities"
                                required
                                data-parsley-required-message="city is required."
                                data-parsley-trigger="change">
                            <option  value="">city</option>
                            <option  value="1">Agadir-Ida -Ou-Tanane</option>
                            <option  value="2">Al Haouz</option>
                            <option value="3">Al Hoceima</option>
                            <option value="5">Aousserd</option>
                            <option selected value="6">Assa-Zag</option>
                            <option value="7">Azilal</option>
                            <option value="8">Béni Mellal</option>
                            <option value="9">Benslimane</option>
                            <option value="10">Berkane</option>
                            <option value="11">Berrechid</option>
                            <option value="12">Boujdour</option>
                            <option value="13">Boulemane</option>
                            <option value="14">Casablanca</option>
                            <option value="15">Chefchaouen</option>
                            <option value="16">Chichaoua</option>
                            <option value="17">Chtouka- Ait Baha</option>
                            <option value="18">Driouch</option>
                            <option value="19">El Hajeb</option>
                            <option value="20">El Jadida</option>
                            <option value="21">El Kelâa des Sraghna</option>
                            <option value="22">Errachidia</option>
                            <option value="24">Es-Semara</option>
                            <option value="23">Essaouira</option>
                            <option value="25">Fahs-Anjra</option>
                            <option value="26">Fès</option>
                            <option value="27">Figuig</option>
                            <option value="28">Fquih Ben Salah</option>
                            <option value="29">Guelmim</option>
                            <option value="30">Guercif</option>
                            <option value="31">Ifrane</option>
                            <option value="32">Inezgane- Ait Melloul</option>
                            <option value="33">Jerada</option>
                            <option value="34">Kénitra</option>
                            <option value="35">Khémisset</option>
                            <option value="36">Khénifra</option>
                            <option value="37">Khouribga</option>
                            <option value="38">Laâyoune</option>
                            <option value="39">Larache</option>
                            <option value="70">M'Diq-Fnideq</option>
                            <option value="40">Marrakech</option>
                            <option value="41">Médiouna</option>
                            <option value="4">Meknès</option>
                            <option value="42">Midelt</option>
                            <option value="43">Mohammadia</option>
                            <option value="75">Moulay Yacoub</option>
                            <option value="44">Nador</option>
                            <option value="45">Nouaceur</option>
                            <option value="47">Ouarzazate</option>
                            <option value="46">Oued Ed-Dahab</option>
                            <option value="48">Ouezzane</option>
                            <option value="49">Oujda-Angad</option>
                            <option value="76">province non spécifiée</option>
                            <option value="77">Provinces étrangères</option>
                            <option value="50">Rabat</option>
                            <option value="51">Rehamna</option>
                            <option value="52">Safi</option>
                            <option value="53">Salé</option>
                            <option value="54">Sefrou</option>
                            <option value="55">Settat</option>
                            <option value="56">Sidi Bennour</option>
                            <option value="57">Sidi Ifni</option>
                            <option value="58">Sidi Kacem</option>
                            <option value="59">Sidi Slimane</option>
                            <option value="60">Skhirate- Témara</option>
                            <option value="62">Tan-Tan</option>
                            <option value="61">Tanger-Assilah</option>
                            <option value="63">Taounate</option>
                            <option value="64">Taourirt</option>
                            <option value="65">Tarfaya</option>
                            <option value="66">Taroudannt</option>
                            <option value="67">Tata</option>
                            <option value="68">Taza</option>
                            <option value="69">Tétouan</option>
                            <option value="71">Tinghir</option>
                            <option value="72">Tiznit</option>
                            <option value="73">Youssoufia</option>
                            <option value="74">Zagora</option>
                        </select>
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">City</span>
                        </label>
                    </div>

                    {{--  phone number  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                class="custom-form__control custom-form__control-input disabled"
                                id="user-signup-phoneNumber"
                                name="user-signup-phoneNumber"
                                data-user="{{$currentUser['phoneNumber'] ?? ''}}"

                                disabled>
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">PHONE NUMBER</span>
                        </label>
                    </div>

                    {{--  email  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                class="custom-form__control custom-form__control-input disabled"
                                id="user-signup-email"
                                name="user-signup-email"

                                data-user="{{$currentUser['email'] ?? ''}}"
                                disabled
                        >
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder">EMAIL</span>
                        </label>
                    </div>

                    {{--  secret Question response  --}}
                    <div class="form-group__custom-control">
                        <input
                                type="text"
                                class="custom-form__control custom-form__control-input"
                                id="user-signup-response"
                                name="user-signup-response"
                                required
                                data-user="how much money you have"
                                data-parsley-required-message="response is required."
                                data-parsley-trigger="keyup">
                        <label for="" class="custom-control__label">
                            <span class="custom-control__label-placeholder"> RESPONSE</span>
                        </label>



                    </div>
                </div>
            </div>
        </div>

        <div class="footer d-flex justify-content-between align-items-center ">
            <input type="submit" id="submit-form" class="base-button shadow" value="SAVE">
        </div>
    </form>
</div>


<script src="/js/app.js?v=<?php echo time()?>"></script>
</body>
</html>
