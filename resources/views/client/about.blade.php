@extends('client.main')
@section('content')

<div class="about section bd-container" id="about">
    <span class="section-subtitle">My history</span>
    <h2 class="section-title">About me</h2>

    <div class="about__container bd-grid">
        <div class="about__data bd-grid">
            <p class="about__description"><span>Hello, I am <br></span>Lorem ipsum dolor sit amet consectetur adipiscing elit blandit fringilla netus, porttitor lectus nisi vitae viverra aenean eu dictum nascetur, pretium sem fames ac feugiat facilisi ullamcorper nec potenti. Hendrerit tincidunt vestibulum per turpis gravida augue pellentesque, nibh donec maecenas sociosqu praesent inceptos sociis commodo, vivamus aliquam nullam eu fusce non. Morbi id iaculis dignissim ridiculus eu commodo platea, curabitur ad non euismod cum.</p>

            <div>
                <span class="about__number">05</span>
                <span class="about__achievement">Years off Experience</span>
            </div>

            <div>
                <span class="about__number">29+</span>
                <span class="about__achievement">Projects completes</span>
            </div>

            <div>
                <span class="about__number">07</span>
                <span class="about__achievement">Best work awards</span>
            </div>
        </div>

        <img src="https://images.unsplash.com/photo-1579591919791-0e3737ae3808?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE3MTMwMzY1NzZ8&ixlib=rb-4.0.3&q=85" alt="" class="about__img">
    </div>
</div>
@endsection
<style>

    /*===== GOOGLE FONTS =====*/
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

    /*===== VARIABLES CSS =====*/
    :root{
        --header-height: 3rem;

        /*===== Colors =====*/
        --first-color: #3E0E12;
        --first-color-dark: #2F0A0D;
        --text-color: #524748;
        --first-color-light: #7B6F71;
        --first-color-lighten: #FBF9F9;

        /*===== Font and typography =====*/
        --body-font: 'Poppins', sans-serif;
        --biggest-font-size: 2.5rem;
        --h1-font-size: 1.5rem;
        --h2-font-size: 1.25rem;
        --h3-font-size: 1.125rem;
        --normal-font-size: .938rem;
        --small-font-size: .813rem;
        --smaller-font-size: .75rem;

        /*===== Font weight =====*/
        --font-medium: 500;
        --font-semi-bold: 600;
        --font-bold: 700;

        /*===== Margins =====*/
        --mb-1: .5rem;
        --mb-2: 1rem;
        --mb-3: 1.5rem;
        --mb-4: 2rem;
        --mb-5: 2.5rem;
        --mb-6: 3rem;

        /*===== z index =====*/
        --z-normal: 1;
        --z-tooltip: 10;
        --z-fixed: 100;
    }

    @media screen and (min-width: 768px){
        :root{
            --biggest-font-size: 4.5rem;
            --h1-font-size: 2.25rem;
            --h2-font-size: 1.5rem;
            --h3-font-size: 1.25rem;
            --normal-font-size: 1rem;
            --small-font-size: .875rem;
            --smaller-font-size: .813rem;
        }
    }

    /*===== BASE =====*/
    *,::before,::after{
        box-sizing: border-box;
    }


    h1,h2,h3,ul,p{
        margin: 0;
    }

    h2,h3{
        font-weight: var(--font-semi-bold);
    }

    ul{
        padding: 0;
        list-style: none;
    }

    a{
        text-decoration: none;
    }

    img{
        max-width: 100%;
        height: auto;
        display: block;
    }

    /*===== CLASS CSS =====*/
    .section {
        padding: 4rem 0 2rem;
    }

    .section-title, .section-subtitle {
        text-align: center;
    }

    .section-title {
        font-size: var(--h1-font-size);
        color: var(--first-color);
        margin-bottom: var(--mb-3);
    }

    .section-subtitle {
        display: block;
        font-size: var(--smaller-font-size);
        font-weight: var(--font-semi-bold);
    }

    /*===== LAYOUT =====*/
    .bd-container {
        max-width: 1024px;
        width: calc(100% - 2rem);
        margin-left: var(--mb-2);
        margin-right: var(--mb-2);
    }

    .bd-grid {
        display: grid;
        gap: 1.5rem;
    }

    .l-header {
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: var(--z-fixed);
        background-color: #000;
    }

    /*===== ABOUT =====*/
    .about__data {
        text-align: center;
    }

    .about__description span {
        font-size: var(--h2-font-size);
        font-weight: var(--font-semi-bold);
        color: var(--first-color);
    }

    .about__number {
        font-size: var(--h1-font-size);
        color: var(--first-color);
        display: block;
    }

    .about__img {
        justify-self: center;
        width: 220px;
        border-radius: .5rem;
        box-shadow: -6px 14px 13px 0px rgba(0,0,0,0.2);
    }

    /*===== MEDIA QUERIES =====*/
    @media screen and (min-width: 576px) {
        .about__container {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media screen and (min-width: 768px) {
        body {
            margin: 0;
        }

        section {
            padding-top: 6rem;
        }

        .section-title {
            margin-bottom: var(--mb-5);
        }

        .about__description {
            text-align: initial;
        }

        .about__img {
            width: 300px;
        }
    }

    @media screen and (min-width: 1024px) {
        .bd-container {
            margin-left: auto;
            margin-right: auto;
        }

        .home__img img {
            width: 740px;
        }
    }
</style>
