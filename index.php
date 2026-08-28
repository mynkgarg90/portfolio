<?php
// ============================================================
// SINGLE FILE 3D PORTFOLIO WEBSITE
// File: index.php
// ============================================================
// ==========================================
// CONTACT FORM EMAIL SETTINGS
// ==========================================

// YAHAN APNI EMAIL ID LIKHO
$adminEmail = "mynkgarg90@gmail.com";

$messageStatus = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {

  // Get form data
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $subject = trim($_POST["subject"] ?? "");
  $message = trim($_POST["message"] ?? "");

  // Basic validation
  if ($name === "" || $email === "" || $subject === "" || $message === "") {

    $messageStatus = "Please fill in all fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $messageStatus = "Please enter a valid email address.";
  } else {

    // Clean data
    $nameSafe = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $emailSafe = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $subjectSafe = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
    $messageSafe = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Email subject
    $mailSubject = "New Portfolio Enquiry - " . $subjectSafe;

    // Email body
    $mailBody = "
========================================
NEW PORTFOLIO CONTACT MESSAGE
========================================

Name:
$nameSafe

Email:
$emailSafe

Subject:
$subjectSafe

Message:
$messageSafe

========================================
Sent from your portfolio website
========================================
";

    // Email headers
    $headers  = "From: Portfolio Website <" . $adminEmail . ">\r\n";
    $headers .= "Reply-To: " . $emailSafe . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($adminEmail, $mailSubject, $mailBody, $headers)) {

      $messageStatus = "Thanks $nameSafe! Your message has been sent successfully.";
    } else {

      $messageStatus = "Sorry! Message could not be sent. Please try again later.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mayank Garg | Freelancer & Digital Marketer</title>
  <meta name="description" content="Mayank Garg — Freelancer, Digital Marketer and Web Developer. Websites, SEO, social media, branding and AI-powered digital solutions.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg: #f7f8fc;
      --surface: #fff;
      --ink: #101522;
      --muted: #697386;
      --line: #e8ebf2;
      --blue: #635bff;
      --cyan: #18a0fb;
      --purple: #9b5cff;
      --green: #16b87f;
      --radius: 28px;
      --shadow: 0 20px 70px rgba(28, 38, 65, .10)
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      scroll-behavior: smooth
    }

    body {
      font-family: "DM Sans", sans-serif;
      background: var(--bg);
      color: var(--ink);
      overflow-x: hidden
    }

    a {
      text-decoration: none;
      color: inherit
    }

    button,
    input,
    textarea {
      font: inherit
    }

    .container {
      width: min(1180px, 90%);
      margin: auto
    }

    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      background: rgba(247, 248, 252, .78);
      backdrop-filter: blur(18px);
      border-bottom: 1px solid rgba(232, 235, 242, .8)
    }

    .nav {
      height: 78px;
      display: flex;
      align-items: center;
      justify-content: space-between
    }

    .logo {
      font-family: "Space Grotesk";
      font-size: 24px;
      font-weight: 700;
      letter-spacing: -1px
    }

    .logo span {
      color: var(--blue)
    }

    .navlinks {
      display: flex;
      gap: 28px;
      color: #5e6677;
      font-size: 14px
    }

    .navlinks a:hover {
      color: var(--blue)
    }

    .navcta {
      padding: 11px 18px;
      border-radius: 50px;
      background: #111827;
      color: white;
      font-size: 14px
    }

    .menu {
      display: none;
      font-size: 25px;
      cursor: pointer
    }

    .hero {
      min-height: 100vh;
      padding: 145px 0 80px;
      display: grid;
      grid-template-columns: 1.05fr .95fr;
      align-items: center;
      gap: 50px;
      position: relative
    }

    .hero:before {
      content: "";
      position: absolute;
      width: 550px;
      height: 550px;
      right: -250px;
      top: 70px;
      background: radial-gradient(circle, rgba(99, 91, 255, .18), transparent 68%);
      filter: blur(10px);
      z-index: -1
    }

    .eyebrow {
      display: inline-flex;
      gap: 9px;
      align-items: center;
      padding: 9px 14px;
      border: 1px solid var(--line);
      background: #fff;
      border-radius: 50px;
      font-size: 12px;
      color: var(--blue);
      font-weight: 700;
      margin-bottom: 22px
    }

    .dot {
      width: 8px;
      height: 8px;
      background: #20c997;
      border-radius: 50%;
      box-shadow: 0 0 12px #20c997
    }

    h1 {
      font-family: "Space Grotesk";
      font-size: clamp(54px, 7vw, 92px);
      line-height: .95;
      letter-spacing: -5px;
      max-width: 800px
    }

    .gradient {
      background: linear-gradient(100deg, #635bff, #1687ff, #9b5cff);
      -webkit-background-clip: text;
      color: transparent
    }

    .hero p {
      max-width: 650px;
      color: var(--muted);
      line-height: 1.8;
      font-size: 17px;
      margin: 26px 0
    }

    .actions {
      display: flex;
      gap: 12px;
      flex-wrap: wrap
    }

    .btn {
      padding: 15px 22px;
      border-radius: 14px;
      font-weight: 700;
      font-size: 14px;
      transition: .3s;
      display: inline-flex;
      align-items: center;
      gap: 9px
    }

    .btn-primary {
      color: white;
      background: linear-gradient(135deg, var(--blue), var(--cyan));
      box-shadow: 0 15px 35px rgba(99, 91, 255, .25)
    }

    .btn-secondary {
      border: 1px solid var(--line);
      background: white
    }

    .btn:hover {
      transform: translateY(-4px)
    }

    .hero3d {
      height: 540px;
      position: relative;
      display: grid;
      place-items: center;
      perspective: 1200px
    }

    .legacy-orb {
      width: 310px;
      height: 310px;
      border-radius: 50%;
      position: relative;
      transform-style: preserve-3d;
      background: radial-gradient(circle at 30% 25%, #fff 0 4%, #9f97ff 10%, #635bff 36%, #1687ff 65%, #14244d 100%);
      box-shadow: inset -35px -30px 65px rgba(0, 0, 0, .25), 0 35px 100px rgba(69, 80, 180, .25);
      animation: orb 8s ease-in-out infinite
    }

    .orb:before,
    .orb:after {
      content: "";
      position: absolute;
      border: 1px solid rgba(255, 255, 255, .55);
      border-radius: 50%;
      inset: -35px 10px;
      transform: rotate(65deg);
      box-shadow: 0 0 30px rgba(99, 91, 255, .15)
    }

    .orb:after {
      inset: -60px 42px;
      transform: rotate(-50deg);
      opacity: .65
    }

    @keyframes orb {
      50% {
        transform: rotateX(10deg) rotateY(25deg) translateY(-20px)
      }
    }

    .float-card {
      position: absolute;
      background: rgba(255, 255, 255, .86);
      backdrop-filter: blur(15px);
      border: 1px solid white;
      box-shadow: var(--shadow);
      border-radius: 18px;
      padding: 17px 20px;
      min-width: 155px
    }

    .fc1 {
      top: 70px;
      left: 10px;
      animation: float 5s ease-in-out infinite
    }

    .fc2 {
      right: 0;
      bottom: 80px;
      animation: float 6s ease-in-out infinite reverse
    }

    .fc3 {
      right: 35px;
      top: 40px;
      animation: float 7s ease-in-out infinite
    }

    @keyframes float {
      50% {
        transform: translateY(-14px) rotate(2deg)
      }
    }

    .fc-label {
      font-size: 10px;
      color: #8992a5;
      text-transform: uppercase;
      letter-spacing: 1.5px
    }

    .fc-value {
      font-family: "Space Grotesk";
      font-size: 25px;
      font-weight: 700;
      margin-top: 4px
    }

    section {
      padding: 105px 0
    }

    .section-head {
      display: flex;
      justify-content: space-between;
      gap: 30px;
      align-items: end;
      margin-bottom: 45px
    }

    .kicker {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 3px;
      color: var(--blue);
      font-weight: 700;
      margin-bottom: 12px
    }

    h2 {
      font-family: "Space Grotesk";
      font-size: clamp(38px, 5vw, 64px);
      letter-spacing: -3px;
      line-height: 1
    }

    .lead {
      color: var(--muted);
      max-width: 540px;
      line-height: 1.8
    }

    .about {
      display: grid;
      grid-template-columns: .85fr 1.15fr;
      gap: 70px;
      align-items: center
    }

    .profile {
      min-height: 500px;
      border-radius: 35px;
      background: linear-gradient(145deg, #dedbff, #eef9ff 55%, #fff);
      position: relative;
      overflow: hidden;
      box-shadow: var(--shadow);
      transform: rotate(-2deg);
      transition: .5s
    }

    .profile:hover {
      transform: rotate(0) translateY(-8px)
    }

    .profile .initial {
      font-family: "Space Grotesk";
      font-size: 180px;
      font-weight: 700;
      color: rgba(99, 91, 255, .12);
      position: absolute;
      inset: 0;
      display: grid;
      place-items: center
    }

    .profile .badge {
      position: absolute;
      bottom: 25px;
      left: 25px;
      background: white;
      border-radius: 18px;
      padding: 15px 18px;
      box-shadow: 0 15px 35px rgba(35, 50, 80, .1)
    }

    .about-copy p {
      color: var(--muted);
      line-height: 1.9;
      margin: 20px 0 30px
    }

    .stats {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px
    }

    .stat {
      padding: 18px;
      background: white;
      border: 1px solid var(--line);
      border-radius: 18px
    }

    .stat b {
      font-family: "Space Grotesk";
      font-size: 27px;
      color: var(--blue)
    }

    .stat span {
      display: block;
      color: var(--muted);
      font-size: 11px;
      margin-top: 4px
    }

    .skills {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 16px
    }

    /* =========================
   3D SKILLS SECTION
========================= */

    .skills {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
      perspective: 1400px;
    }

    .skill {
      position: relative;
      min-height: 245px;
      padding: 30px;
      overflow: hidden;

      background:
        linear-gradient(145deg,
          rgba(255, 255, 255, .98),
          rgba(247, 248, 255, .92));

      border: 1px solid rgba(99, 91, 255, .12);
      border-radius: 26px;

      transform-style: preserve-3d;
      transition:
        transform .15s ease-out,
        box-shadow .35s ease,
        border-color .35s ease;

      will-change: transform;
    }

    /* Mouse light */
    .skill::before {
      content: "";
      position: absolute;
      inset: -50%;

      background:
        radial-gradient(circle at var(--sx, 50%) var(--sy, 50%),
          rgba(99, 91, 255, .22),
          transparent 28%);

      opacity: 0;
      transition: .3s;
      pointer-events: none;
    }

    /* Glass shine */
    .skill::after {
      content: "";
      position: absolute;
      inset: 1px;

      border-radius: 25px;

      background:
        linear-gradient(120deg,
          rgba(255, 255, 255, .75),
          transparent 35%,
          rgba(24, 160, 251, .06));

      pointer-events: none;
    }

    /* Hover */
    .skill:hover {
      border-color: rgba(99, 91, 255, .28);

      box-shadow:
        0 28px 70px rgba(50, 62, 130, .16),
        0 0 0 1px rgba(99, 91, 255, .12);
    }

    .skill:hover::before {
      opacity: 1;
    }

    /* Icon */
    .skill .icon {
      width: 62px;
      height: 62px;

      display: grid;
      place-items: center;

      font-size: 28px;

      margin-bottom: 35px;

      border-radius: 18px;

      background:
        linear-gradient(145deg,
          #ffffff,
          #ecebff);

      box-shadow:
        inset 0 1px 0 #fff,
        0 12px 25px rgba(75, 70, 170, .12);

      transform: translateZ(40px);

      position: relative;
      z-index: 2;
    }

    /* Heading */
    .skill h3 {
      font-family: "Space Grotesk";
      font-size: 20px;
      margin-bottom: 9px;

      transform: translateZ(30px);

      position: relative;
      z-index: 2;
    }

    /* Description */
    .skill p {
      color: var(--muted);
      font-size: 13px;
      line-height: 1.7;

      transform: translateZ(20px);

      position: relative;
      z-index: 2;
    }

    /* Bottom gradient line */
    .skill-line {
      position: absolute;

      left: 30px;
      right: 30px;
      bottom: 20px;

      height: 3px;

      border-radius: 20px;

      background:
        linear-gradient(90deg,
          var(--blue),
          var(--cyan),
          var(--purple));

      transform: translateZ(18px);

      opacity: .7;
    }

    .services {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px
    }

    .service {
      padding: 35px;
      background: white;
      border: 1px solid var(--line);
      border-radius: 25px;
      display: grid;
      grid-template-columns: 60px 1fr;
      gap: 20px;
      transition: .35s
    }

    .service:hover {
      box-shadow: var(--shadow);
      transform: translateY(-7px)
    }

    .service-num {
      font-family: "Space Grotesk";
      color: var(--blue);
      font-size: 14px
    }

    .service h3 {
      font-family: "Space Grotesk";
      font-size: 26px;
      margin-bottom: 10px
    }

    .service p {
      color: var(--muted);
      line-height: 1.75;
      font-size: 14px
    }

    /* =========================
   PREMIUM PROJECTS SECTION
========================= */

    .projects {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 28px;
      margin-top: 45px;
    }

    /* Project Card */
    .project {
      position: relative;
      min-height: 390px;
      overflow: hidden;
      border-radius: 28px;
      padding: 30px;
      display: flex;
      align-items: flex-end;

      background: #11172d;
      color: #fff;

      isolation: isolate;
      transform-style: preserve-3d;

      box-shadow:
        0 20px 60px rgba(0, 0, 0, .18);

      transition:
        transform .5s ease,
        box-shadow .5s ease;
    }

    /* Project Image */
    .project-image {
      position: absolute;
      inset: 0;

      width: 100%;
      height: 100%;

      object-fit: cover;

      z-index: -3;

      transition:
        transform .7s ease,
        filter .5s ease;
    }

    /* Dark Gradient */
    .project::before {
      content: "";

      position: absolute;
      inset: 0;

      z-index: -2;

      background:
        linear-gradient(to top,
          rgba(5, 8, 25, .98) 0%,
          rgba(5, 8, 25, .72) 42%,
          rgba(5, 8, 25, .15) 100%);
    }

    /* Glow */
    .project::after {
      content: "";

      position: absolute;
      width: 220px;
      height: 220px;

      right: -80px;
      top: -80px;

      border-radius: 50%;

      background: rgba(120, 140, 255, .25);

      filter: blur(50px);

      z-index: -1;

      opacity: 0;

      transition: .5s ease;
    }

    /* Hover */
    .project:hover {
      transform:
        translateY(-12px) scale(1.015);

      box-shadow:
        0 35px 90px rgba(0, 0, 0, .30);
    }

    .project:hover .project-image {
      transform: scale(1.10);
      filter: brightness(.85) saturate(1.15);
    }

    .project:hover::after {
      opacity: 1;
    }

    /* Number */
    .project .big {
      position: absolute;

      top: 20px;
      right: 25px;

      font-size: 80px;
      font-weight: 900;

      line-height: 1;

      color: rgba(255, 255, 255, .10);

      pointer-events: none;

      transition: .5s ease;
    }

    .project:hover .big {
      color: rgba(255, 255, 255, .20);
      transform: translateZ(30px) scale(1.08);
    }

    /* Content */
    .project-content {
      position: relative;
      z-index: 5;

      max-width: 90%;

      transform: translateZ(35px);
    }

    /* Small Category */
    .project-tag {
      display: inline-flex;

      padding: 7px 13px;

      margin-bottom: 12px;

      border-radius: 50px;

      background: rgba(255, 255, 255, .12);

      border: 1px solid rgba(255, 255, 255, .20);

      backdrop-filter: blur(12px);

      font-size: 11px;
      font-weight: 700;

      letter-spacing: 1px;
      text-transform: uppercase;
    }

    /* Title */
    .project h3 {
      margin: 0 0 8px;

      font-size: 28px;
      line-height: 1.15;

      color: #fff;
    }

    /* Description */
    .project p {
      margin: 0 0 18px;

      color: rgba(255, 255, 255, .75);

      font-size: 14px;
    }

    /* Button */
    .project a {
      display: inline-flex;
      align-items: center;
      gap: 8px;

      padding: 11px 17px;

      border-radius: 50px;

      color: #fff;

      text-decoration: none;

      background: rgba(255, 255, 255, .13);

      border: 1px solid rgba(255, 255, 255, .25);

      backdrop-filter: blur(12px);

      transition: .35s ease;
    }

    .project a:hover {
      background: #fff;
      color: #11172d;

      transform: translateY(-3px);
    }


    /* =========================
   FEATURED PROJECTS
========================= */

    .project:nth-child(1) {
      grid-column: span 2;
      min-height: 460px;
    }

    .project:nth-child(1) h3 {
      font-size: 38px;
    }

    .project:nth-child(2) {
      min-height: 410px;
    }


    /* =========================
   MOBILE
========================= */

    @media (max-width: 768px) {

      .projects {
        grid-template-columns: 1fr;
        gap: 20px;
      }

      .project,
      .project:nth-child(1),
      .project:nth-child(2) {
        grid-column: span 1;
        min-height: 360px;
      }

      .project:nth-child(1) h3 {
        font-size: 28px;
      }

      .project h3 {
        font-size: 24px;
      }

      .project .big {
        font-size: 60px;
      }
    }

    .pricing {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 18px
    }

    .price {
      background: white;
      border: 1px solid var(--line);
      border-radius: 28px;
      padding: 32px;
      position: relative
    }

    .price.featured {
      border: 2px solid var(--blue);
      transform: translateY(-12px);
      box-shadow: var(--shadow)
    }

    .tag {
      position: absolute;
      top: 18px;
      right: 18px;
      background: #eeecff;
      color: var(--blue);
      padding: 6px 10px;
      border-radius: 50px;
      font-size: 10px;
      font-weight: 700
    }

    .price h3 {
      font-family: "Space Grotesk";
      font-size: 24px
    }

    .amount {
      font: 700 43px "Space Grotesk";
      margin: 22px 0
    }

    .price p,
    .price li {
      color: var(--muted);
      font-size: 13px;
      line-height: 1.8
    }

    .price ul {
      margin: 22px 0;
      display: grid;
      gap: 10px
    }

    .price li:before {
      content: "✓";
      color: var(--green);
      font-weight: 700;
      margin-right: 9px
    }

    .journey {
      border-left: 1px solid #dce1eb;
      margin-left: 10px
    }

    .jitem {
      padding: 0 0 45px 35px;
      position: relative
    }

    .jitem:before {
      content: "";
      position: absolute;
      left: -6px;
      top: 3px;
      width: 11px;
      height: 11px;
      background: var(--blue);
      border-radius: 50%;
      box-shadow: 0 0 18px rgba(99, 91, 255, .5)
    }

    .jitem small {
      color: var(--blue);
      font-weight: 700
    }

    .jitem h3 {
      font: 700 23px "Space Grotesk";
      margin: 8px 0
    }

    .jitem p {
      color: var(--muted);
      line-height: 1.8;
      max-width: 750px
    }

    .contact {
      background: #111827;
      color: white;
      border-radius: 35px;
      padding: 65px;
      display: grid;
      grid-template-columns: .8fr 1.2fr;
      gap: 55px;
      position: relative;
      overflow: hidden
    }

    .contact:after {
      content: "";
      position: absolute;
      width: 400px;
      height: 400px;
      right: -180px;
      top: -180px;
      background: radial-gradient(circle, rgba(99, 91, 255, .55), transparent 68%)
    }

    .contact h2 {
      position: relative;
      z-index: 1
    }

    .contact p {
      color: #aab3c5;
      line-height: 1.8;
      margin-top: 20px;
      position: relative;
      z-index: 1
    }

    .form {
      position: relative;
      z-index: 2
    }

    .row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px
    }

    input,
    textarea {
      width: 100%;
      background: rgba(255, 255, 255, .07);
      border: 1px solid rgba(255, 255, 255, .12);
      color: white;
      border-radius: 13px;
      padding: 15px;
      outline: none;
      margin-bottom: 12px
    }

    textarea {
      min-height: 145px;
      resize: vertical
    }

    /* =========================================
   PREMIUM SERVICE CARDS
========================================= */

    .services {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
      perspective: 1400px;
    }

    .service-card {
      position: relative;
      min-height: 300px;
      padding: 32px;

      overflow: hidden;

      border-radius: 30px;

      background:
        linear-gradient(145deg,
          #ffffff,
          #f4f5ff);

      border: 1px solid rgba(99, 91, 255, .12);

      box-shadow:
        0 15px 45px rgba(35, 50, 80, .07);

      transform-style: preserve-3d;

      transition:
        transform .18s ease,
        box-shadow .35s ease,
        border-color .35s ease;

      cursor: pointer;
    }

    /* BIG background number */

    .service-card::before {
      content: attr(data-number);

      position: absolute;

      right: -10px;
      top: -35px;

      font:
        800 150px "Space Grotesk";

      color: rgba(99, 91, 255, .055);

      pointer-events: none;

      transition: .5s;
    }

    /* Animated glow */

    .service-card::after {
      content: "";

      position: absolute;

      width: 220px;
      height: 220px;

      right: -100px;
      bottom: -100px;

      border-radius: 50%;

      background:
        radial-gradient(circle,
          rgba(99, 91, 255, .25),
          transparent 70%);

      transition: .5s;

      pointer-events: none;
    }

    /* Hover */

    .service-card:hover {
      transform:
        translateY(-12px) rotateX(5deg) rotateY(-4deg);

      border-color: rgba(99, 91, 255, .3);

      box-shadow:
        0 35px 80px rgba(50, 62, 130, .17);
    }

    .service-card:hover::after {
      transform: scale(1.5);
    }


    /* Icon */

    .service-icon {
      width: 65px;
      height: 65px;

      display: grid;
      place-items: center;

      font-size: 29px;

      border-radius: 20px;

      background:
        linear-gradient(145deg,
          #ffffff,
          #e9e7ff);

      box-shadow:
        0 15px 30px rgba(70, 65, 170, .13),
        inset 0 1px 0 #fff;

      transform: translateZ(45px);

      position: relative;
      z-index: 2;

      transition: .4s;
    }

    .service-card:hover .service-icon {
      transform:
        translateZ(65px) rotate(-8deg) scale(1.08);
    }


    /* Number */

    .service-number {
      position: absolute;

      right: 28px;
      top: 30px;

      font:
        700 13px "Space Grotesk";

      color: var(--blue);

      letter-spacing: 2px;

      z-index: 3;
    }


    /* Heading */

    .service-card h3 {
      position: relative;
      z-index: 3;

      margin-top: 55px;
      margin-bottom: 12px;

      font:
        700 27px "Space Grotesk";

      transform: translateZ(35px);

      transition: .35s;
    }

    .service-card:hover h3 {
      transform: translateZ(50px);
    }


    /* Description */

    .service-card p {
      position: relative;
      z-index: 3;

      max-width: 430px;

      color: var(--muted);

      font-size: 14px;

      line-height: 1.8;

      transform: translateZ(25px);
    }


    /* Arrow */

    .service-arrow {
      position: absolute;

      right: 28px;
      bottom: 25px;

      width: 42px;
      height: 42px;

      display: grid;
      place-items: center;

      border-radius: 50%;

      background: #111827;
      color: white;

      font-size: 20px;

      transform:
        translateZ(35px);

      transition: .4s;

      z-index: 5;
    }

    .service-card:hover .service-arrow {
      transform:
        translateZ(60px) rotate(45deg);

      background:
        linear-gradient(135deg,
          var(--blue),
          var(--cyan));
    }


    /* Mobile */

    @media(max-width:800px) {

      .services {
        grid-template-columns: 1fr;
      }

      .service-card {
        min-height: 280px;
      }

    }

    .send {
      width: 100%;
      padding: 16px;
      border: 0;
      border-radius: 13px;
      color: white;
      font-weight: 700;
      background: linear-gradient(135deg, var(--blue), var(--cyan));
      cursor: pointer
    }

    .status {
      padding: 12px;
      border-radius: 12px;
      background: rgba(22, 184, 127, .15);
      color: #73e0b7;
      margin-bottom: 12px;
      font-size: 13px
    }

    footer {
      padding: 28px 0;
      border-top: 1px solid var(--line);
      color: var(--muted);
      font-size: 13px
    }

    .foot {
      display: flex;
      justify-content: space-between;
      gap: 20px
    }

    .social {
      display: flex;
      gap: 18px
    }

    .social a:hover {
      color: var(--blue)
    }

    .reveal {
      opacity: 0;
      transform: translateY(35px);
      filter: blur(5px);
      transition: 1s cubic-bezier(.2, .8, .2, 1)
    }

    .reveal.show {
      opacity: 1;
      transform: none;
      filter: none
    }

    #particles {
      position: fixed;
      inset: 0;
      z-index: -2;
      pointer-events: none
    }

    .particle {
      position: absolute;
      width: 3px;
      height: 3px;
      border-radius: 50%;
      background: #635bff;
      opacity: .18;
      animation: drift var(--d) linear infinite
    }

    @keyframes drift {
      from {
        transform: translateY(110vh)
      }

      to {
        transform: translateY(-10vh) translateX(var(--x))
      }
    }

    @media(max-width:900px) {

      .hero,
      .about,
      .contact {
        grid-template-columns: 1fr
      }

      .hero3d {
        height: 430px
      }

      .skills {
        grid-template-columns: repeat(2, 1fr)
      }

      .projects .project,
      .projects .project:nth-child(1),
      .projects .project:nth-child(2) {
        grid-column: span 6
      }

      .pricing {
        grid-template-columns: 1fr
      }

      .price.featured {
        transform: none
      }
    }

    @media(max-width:650px) {

      .navlinks,
      .navcta {
        display: none
      }

      .menu {
        display: block
      }

      .navlinks.open {
        display: flex;
        position: absolute;
        top: 78px;
        left: 0;
        width: 100%;
        padding: 22px 5%;
        background: white;
        flex-direction: column;
        border-bottom: 1px solid var(--line)
      }

      section {
        padding: 80px 0
      }

      .hero {
        padding-top: 125px
      }

      .hero3d {
        height: 370px;
        transform: scale(.82)
      }

      h1 {
        letter-spacing: -3px
      }

      .section-head {
        display: block
      }

      .skills,
      .services,
      .stats {
        grid-template-columns: 1fr
      }

      .projects .project,
      .projects .project:nth-child(1),
      .projects .project:nth-child(2) {
        grid-column: span 12
      }

      .contact {
        padding: 35px 25px
      }

      .row {
        grid-template-columns: 1fr
      }

      .foot {
        flex-direction: column
      }

      .profile {
        min-height: 400px
      }
    }

    .hero3d {
      height: 600px;
      position: relative;
      display: grid;
      place-items: center;
      perspective: 1400px
    }

    .hero-anime-wrap {
      position: relative;
      width: min(650px, 100%);
      border-radius: 34px;
      transform-style: preserve-3d;
      transition: transform .12s cubic-bezier(.2, .8, .2, 1);
      filter: drop-shadow(0 35px 60px rgba(20, 35, 90, .28));
      will-change: transform;
      --mx: 50%;
      --my: 50%
    }

    .hero-anime-wrap:before {
      content: "";
      position: absolute;
      inset: 8%;
      background: radial-gradient(circle, rgba(99, 91, 255, .25), transparent 68%);
      filter: blur(35px);
      z-index: -2
    }

    .hero-anime {
      display: block;
      width: 100%;
      height: auto;
      border-radius: 30px;
      position: relative;
      z-index: 1;
      border: 1px solid rgba(255, 255, 255, .45);
      box-shadow: 0 30px 80px rgba(27, 40, 90, .25)
    }

    .anime-glow {
      position: absolute;
      inset: -3px;
      border-radius: 34px;
      background: linear-gradient(120deg, rgba(24, 160, 251, .7), transparent 30%, rgba(155, 92, 255, .65), transparent 75%);
      filter: blur(16px);
      opacity: .45;
      z-index: 0
    }

    .anime-scan {
      position: absolute;
      left: 5%;
      right: 5%;
      top: 8%;
      height: 2px;
      background: linear-gradient(90deg, transparent, #4ee8ff, transparent);
      box-shadow: 0 0 20px #18a0fb;
      z-index: 2;
      opacity: .45;
      animation: scan 5s ease-in-out infinite
    }

    @keyframes scan {

      0%,
      100% {
        top: 8%;
        opacity: 0
      }

      20% {
        opacity: .5
      }

      50% {
        top: 88%;
        opacity: .25
      }

      75% {
        opacity: .5
      }
    }

    .anime-float {
      position: absolute;
      z-index: 3;
      background: rgba(12, 20, 46, .82);
      color: #fff;
      border: 1px solid rgba(114, 199, 255, .35);
      box-shadow: 0 15px 35px rgba(20, 30, 70, .25);
      backdrop-filter: blur(12px);
      border-radius: 50px;
      padding: 10px 15px;
      font: 700 10px "Space Grotesk";
      letter-spacing: 1px
    }

    .anime-float-1 {
      left: -18px;
      bottom: 85px;
      animation: afloat 4.5s ease-in-out infinite
    }

    .anime-float-2 {
      right: -18px;
      top: 105px;
      animation: afloat 5.5s ease-in-out infinite reverse
    }

    @keyframes afloat {
      50% {
        transform: translateY(-12px) translateZ(25px)
      }
    }

    @media(max-width:900px) {
      .hero3d {
        height: 470px
      }

      .anime-float-1 {
        left: 0
      }

      .anime-float-2 {
        right: 0
      }
    }

    @media(max-width:650px) {
      .hero3d {
        height: auto;
        min-height: 350px
      }

      .hero-anime-wrap {
        width: 110%;
        margin-left: -5%
      }

      .anime-float {
        font-size: 8px;
        padding: 8px 11px
      }

      .anime-float-1 {
        bottom: 35px
      }

      .anime-float-2 {
        top: 35px
      }
    }

    .hero3d {
      overflow: visible;
      isolation: isolate
    }

    .hero3d:before {
      content: "";
      position: absolute;
      width: 420px;
      height: 420px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(24, 160, 251, .18), transparent 68%);
      filter: blur(20px);
      transform: translate3d(calc(var(--px, 0px)*.35), calc(var(--py, 0px)*.35), -120px);
      pointer-events: none;
      transition: transform .25s ease-out
    }

    .hero-anime-wrap:after {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: 34px;
      z-index: 4;
      pointer-events: none;
      background: radial-gradient(circle at var(--mx) var(--my), rgba(255, 255, 255, .28), transparent 17%), linear-gradient(115deg, rgba(255, 255, 255, .12), transparent 35%, transparent 65%, rgba(99, 91, 255, .12));
      mix-blend-mode: screen;
      opacity: .75
    }

    .anime-glow {
      animation: glowPulse 4s ease-in-out infinite
    }

    @keyframes glowPulse {
      50% {
        opacity: .72;
        filter: blur(22px);
        transform: scale(1.025)
      }
    }

    .anime-scan {
      animation: scan 4.2s ease-in-out infinite
    }

    .anime-float {
      transform-style: preserve-3d
    }

    .hero-orbit {
      position: absolute;
      inset: -8%;
      border: 1px solid rgba(99, 91, 255, .18);
      border-radius: 50%;
      transform: rotateX(65deg) rotateZ(0deg);
      pointer-events: none;
      animation: orbitSpin 18s linear infinite
    }

    .hero-orbit:before,
    .hero-orbit:after {
      content: "";
      position: absolute;
      width: 9px;
      height: 9px;
      border-radius: 50%;
      background: #18a0fb;
      box-shadow: 0 0 22px #18a0fb;
      top: 50%;
      left: -4px
    }

    .hero-orbit:after {
      left: auto;
      right: -4px;
      background: #9b5cff;
      box-shadow: 0 0 22px #9b5cff
    }

    @keyframes orbitSpin {
      to {
        transform: rotateX(65deg) rotateZ(360deg)
      }
    }

    .cursor-light {
      position: fixed;
      left: 0;
      top: 0;
      width: 220px;
      height: 220px;
      border-radius: 50%;
      pointer-events: none;
      z-index: 9999;
      background: radial-gradient(circle, rgba(99, 91, 255, .16), rgba(24, 160, 251, .06) 35%, transparent 70%);
      transform: translate(-50%, -50%);
      mix-blend-mode: multiply;
      opacity: 0;
      transition: opacity .25s
    }

    @media(max-width:900px) {
      .hero-orbit {
        inset: -4%
      }
    }

    @media(max-width:650px) {
      .hero-orbit {
        inset: 0;
        transform: rotateX(65deg) rotateZ(0deg)
      }

      .cursor-light {
        display: none
      }
    }


    /* ===== ADVANCED 3D / CURSOR EXPERIENCE ===== */
    html {
      cursor: none
    }

    body {
      background:
        radial-gradient(circle at 15% 10%, rgba(99, 91, 255, .10), transparent 28%),
        radial-gradient(circle at 85% 35%, rgba(24, 160, 251, .08), transparent 30%),
        var(--bg)
    }

    body:before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -3;
      pointer-events: none;
      opacity: .28;
      background-image: linear-gradient(rgba(99, 91, 255, .07) 1px, transparent 1px), linear-gradient(90deg, rgba(99, 91, 255, .07) 1px, transparent 1px);
      background-size: 55px 55px;
      mask-image: linear-gradient(to bottom, black, transparent 85%)
    }

    .scroll-progress {
      position: fixed;
      left: 0;
      top: 0;
      height: 3px;
      width: 0;
      z-index: 10001;
      background: linear-gradient(90deg, var(--cyan), var(--blue), var(--purple));
      box-shadow: 0 0 18px rgba(99, 91, 255, .8)
    }

    .cursor-dot {
      position: fixed;
      left: 0;
      top: 0;
      width: 7px;
      height: 7px;
      border-radius: 50%;
      background: #fff;
      box-shadow: 0 0 14px #18a0fb, 0 0 30px #635bff;
      pointer-events: none;
      z-index: 10003;
      transform: translate(-50%, -50%);
      mix-blend-mode: difference
    }

    .cursor-ring {
      position: fixed;
      left: 0;
      top: 0;
      width: 38px;
      height: 38px;
      border: 1px solid rgba(99, 91, 255, .8);
      border-radius: 50%;
      pointer-events: none;
      z-index: 10002;
      transform: translate(-50%, -50%);
      transition: width .2s, height .2s, border-color .2s, background .2s;
      mix-blend-mode: difference
    }

    .cursor-ring.hover {
      width: 72px;
      height: 72px;
      border-color: rgba(24, 160, 251, .9);
      background: rgba(24, 160, 251, .08)
    }

    .cursor-ring.click {
      width: 24px;
      height: 24px
    }

    .cursor-label {
      position: fixed;
      left: 0;
      top: 0;
      pointer-events: none;
      z-index: 10004;
      font: 700 8px "Space Grotesk";
      letter-spacing: 1px;
      color: white;
      transform: translate(-50%, -50%);
      opacity: 0;
      transition: opacity .2s
    }

    body.cursor-active .cursor-label {
      opacity: 1
    }

    .magnetic {
      will-change: transform;
      transition: transform .2s cubic-bezier(.2, .8, .2, 1)
    }

    [data-tilt] {
      transform-style: preserve-3d;
      will-change: transform;
      transition: transform .18s ease, box-shadow .3s ease
    }

    [data-tilt]>* {
      transform: translateZ(18px)
    }

    .skill,
    .service,
    .price,
    .project,
    .profile {
      position: relative;
      overflow: hidden
    }

    .skill:after,
    .service:after,
    .price:after,
    .project:after,
    .profile:after {
      content: "";
      position: absolute;
      width: 180px;
      height: 180px;
      border-radius: 50%;
      left: var(--spot-x, 50%);
      top: var(--spot-y, 50%);
      transform: translate(-50%, -50%);
      background: radial-gradient(circle, rgba(255, 255, 255, .30), transparent 65%);
      pointer-events: none;
      opacity: 0;
      transition: opacity .2s
    }

    .skill:hover:after,
    .service:hover:after,
    .price:hover:after,
    .project:hover:after,
    .profile:hover:after {
      opacity: 1
    }

    .project {
      box-shadow: inset 0 0 0 1px rgba(255, 255, 255, .08), 0 22px 55px rgba(31, 42, 90, .12)
    }

    .project .big {
      transform: translateZ(35px);
      transition: transform .4s
    }

    .project:hover .big {
      transform: translateZ(55px) rotate(-4deg)
    }

    .hero-anime-wrap {
      box-shadow: 0 35px 100px rgba(45, 54, 130, .18)
    }

    .hero-anime {
      transform: translateZ(25px)
    }

    @media(max-width:900px) {
      html {
        cursor: auto
      }

      .cursor-dot,
      .cursor-ring,
      .cursor-label {
        display: none
      }
    }


    /* ===== FULL PAGE ANIMATED BACKGROUND ===== */
    body {
      background: var(--bg);
      position: relative;
      isolation: isolate;
    }

    body::after {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -4;
      pointer-events: none;
      background:
        radial-gradient(circle at 20% 20%, rgba(99, 91, 255, .13), transparent 30%),
        radial-gradient(circle at 80% 15%, rgba(24, 160, 251, .11), transparent 28%),
        radial-gradient(circle at 50% 85%, rgba(155, 92, 255, .10), transparent 32%);
      filter: blur(18px);
      animation: bgShift 14s ease-in-out infinite alternate;
    }

    @keyframes bgShift {
      0% {
        transform: scale(1) rotate(0deg);
        filter: blur(18px) hue-rotate(0deg)
      }

      50% {
        transform: scale(1.12) rotate(4deg);
        filter: blur(28px) hue-rotate(18deg)
      }

      100% {
        transform: scale(1.04) rotate(-3deg);
        filter: blur(20px) hue-rotate(-12deg)
      }
    }

    #animated-bg {
      position: fixed;
      inset: 0;
      z-index: -3;
      overflow: hidden;
      pointer-events: none;
      background:
        linear-gradient(rgba(99, 91, 255, .045) 1px, transparent 1px),
        linear-gradient(90deg, rgba(24, 160, 251, .035) 1px, transparent 1px),
        rgba(247, 248, 252, .88);
      background-size: 65px 65px;
      animation: gridMove 20s linear infinite;
    }

    #animated-bg::before,
    #animated-bg::after {
      content: "";
      position: absolute;
      width: 42vw;
      height: 42vw;
      min-width: 360px;
      min-height: 360px;
      border-radius: 50%;
      filter: blur(70px);
      opacity: .18;
    }

    #animated-bg::before {
      background: #b9b4ff;
      top: -15%;
      left: -10%;
      animation: blobOne 17s ease-in-out infinite alternate;
    }

    #animated-bg::after {
      background: #9edbff;
      right: -12%;
      bottom: -18%;
      animation: blobTwo 20s ease-in-out infinite alternate;
    }

    @keyframes gridMove {
      from {
        background-position: 0 0, 0 0
      }

      to {
        background-position: 65px 65px, 65px 65px
      }
    }

    @keyframes blobOne {
      0% {
        transform: translate3d(0, 0, 0) scale(1)
      }

      50% {
        transform: translate3d(45vw, 18vh, 0) scale(1.28)
      }

      100% {
        transform: translate3d(18vw, 55vh, 0) scale(.9)
      }
    }

    @keyframes blobTwo {
      0% {
        transform: translate3d(0, 0, 0) scale(1)
      }

      50% {
        transform: translate3d(-42vw, -28vh, 0) scale(1.25)
      }

      100% {
        transform: translate3d(-12vw, -58vh, 0) scale(.85)
      }
    }

    section,
    .container,
    header,
    footer {
      position: relative
    }

    section::before {
      content: "";
      position: absolute;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(99, 91, 255, .09), transparent 70%);
      filter: blur(20px);
      pointer-events: none;
      z-index: -1;
      animation: sectionGlow 9s ease-in-out infinite alternate;
    }

    section:nth-of-type(even)::before {
      right: 5%;
      top: 10%;
      background: radial-gradient(circle, rgba(24, 160, 251, .08), transparent 70%);
    }

    @keyframes sectionGlow {
      from {
        transform: translate(-20px, -10px) scale(.9);
        opacity: .45
      }

      to {
        transform: translate(45px, 35px) scale(1.2);
        opacity: 1
      }
    }

    @media(max-width:650px) {
      #animated-bg {
        background-size: 42px 42px
      }

      #animated-bg::before,
      #animated-bg::after {
        filter: blur(55px);
        opacity: .26
      }
    }


    /* ===== LIGHT THEME SAFETY ===== */
    header {
      background: rgba(247, 248, 252, .82)
    }


    /* ===== FULL PAGE MOVING OBSTACLES ===== */
    #bg-obstacles {
      position: fixed;
      inset: 0;
      z-index: -1;
      pointer-events: none;
      overflow: hidden;
      perspective: 900px;
    }

    .bg-obstacle {
      position: absolute;
      width: var(--size);
      height: var(--size);
      left: var(--left);
      top: var(--top);
      opacity: var(--opacity);
      transform-style: preserve-3d;
      will-change: transform;
      filter: drop-shadow(0 10px 22px rgba(70, 80, 170, .12));
    }

    .bg-obstacle::before {
      content: "";
      position: absolute;
      inset: 0;
      border: 1px solid rgba(99, 91, 255, .30);
      background: linear-gradient(135deg, rgba(99, 91, 255, .10), rgba(24, 160, 251, .025));
      box-shadow: inset 0 0 22px rgba(99, 91, 255, .08), 0 0 20px rgba(99, 91, 255, .07);
    }

    .bg-obstacle.circle::before {
      border-radius: 50%;
    }

    .bg-obstacle.square::before {
      border-radius: 16%;
      transform: rotate(45deg);
    }

    .bg-obstacle.diamond::before {
      border-radius: 12%;
      transform: rotate(45deg) scale(.72);
    }

    .bg-obstacle.ring::before {
      border-radius: 50%;
      background: transparent;
      border: 2px solid rgba(24, 160, 251, .24);
      box-shadow: 0 0 28px rgba(24, 160, 251, .13), inset 0 0 18px rgba(24, 160, 251, .08);
    }

    .bg-obstacle.cross::before {
      border: 0;
      background:
        linear-gradient(rgba(99, 91, 255, .16), rgba(99, 91, 255, .16)) center/100% 18% no-repeat,
        linear-gradient(rgba(24, 160, 251, .12), rgba(24, 160, 251, .12)) center/18% 100% no-repeat;
    }

    .bg-obstacle::after {
      content: "";
      position: absolute;
      width: 28%;
      height: 28%;
      left: 36%;
      top: 36%;
      border-radius: 50%;
      background: #635bff;
      box-shadow: 0 0 16px #635bff, 0 0 34px rgba(24, 160, 251, .5);
      opacity: .35;
    }

    .bg-obstacle.ring::after {
      background: #18a0fb;
      box-shadow: 0 0 15px #18a0fb, 0 0 30px rgba(24, 160, 251, .55);
    }

    .profile img {
      width: 100%;
      height: 100%;
      min-height: 500px;
      object-fit: cover;
      display: block;
      border-radius: 35px;
    }

    @keyframes obstacleFloat1 {
      0% {
        transform: translate3d(0, 0, 0) rotate(0deg)
      }

      25% {
        transform: translate3d(55px, -75px, 80px) rotate(90deg)
      }

      50% {
        transform: translate3d(-35px, -145px, 20px) rotate(180deg)
      }

      75% {
        transform: translate3d(-90px, -55px, -60px) rotate(270deg)
      }

      100% {
        transform: translate3d(0, 0, 0) rotate(360deg)
      }
    }

    @keyframes obstacleFloat2 {
      0% {
        transform: translate3d(0, 0, 0) rotate(45deg) scale(1)
      }

      50% {
        transform: translate3d(-90px, 90px, 100px) rotate(225deg) scale(1.16)
      }

      100% {
        transform: translate3d(0, 0, 0) rotate(405deg) scale(1)
      }
    }

    @keyframes obstacleFloat3 {
      0% {
        transform: translate3d(0, 0, 0) rotateX(0) rotateY(0)
      }

      50% {
        transform: translate3d(100px, -45px, 120px) rotateX(180deg) rotateY(90deg)
      }

      100% {
        transform: translate3d(0, 0, 0) rotateX(360deg) rotateY(180deg)
      }
    }

    @keyframes obstacleFloat4 {
      0% {
        transform: translate3d(0, 0, 0) rotate(0) scale(.85)
      }

      50% {
        transform: translate3d(-65px, 120px, -80px) rotate(-180deg) scale(1.2)
      }

      100% {
        transform: translate3d(0, 0, 0) rotate(-360deg) scale(.85)
      }
    }

    @media(max-width:650px) {
      #bg-obstacles {
        opacity: .65
      }

      .bg-obstacle {
        transform: scale(.72)
      }
    }

    @media(prefers-reduced-motion:reduce) {
      .bg-obstacle {
        animation: none !important
      }
    }
  </style>

  <style id="real-redesign">
    /* ===== REAL VISUAL REDESIGN v2 ===== */
    :root {
      --neon: #6d5dfc;
      --electric: #00b8ff;
      --violet: #b05cff
    }

    body {
      background: #f4f6ff !important
    }

    header {
      background: rgba(255, 255, 255, .72) !important;
      border-bottom: 1px solid rgba(99, 91, 255, .10) !important
    }

    header.scrolled {
      background: rgba(255, 255, 255, .92) !important;
      box-shadow: 0 15px 45px rgba(40, 50, 100, .10)
    }

    .hero {
      min-height: 100vh !important;
      align-items: center
    }

    .hero>div:first-child {
      position: relative;
      z-index: 5
    }

    .hero h1 {
      font-size: clamp(62px, 7vw, 104px) !important;
      line-height: .88 !important;
      letter-spacing: -6px !important
    }

    .hero h1:after {
      content: "";
      display: block;
      width: 120px;
      height: 7px;
      border-radius: 10px;
      background: linear-gradient(90deg, var(--neon), var(--electric), var(--violet));
      margin-top: 26px
    }

    .eyebrow {
      box-shadow: 0 12px 35px rgba(60, 70, 130, .08) !important;
      border-color: rgba(99, 91, 255, .12) !important
    }

    .btn {
      border-radius: 18px !important;
      padding: 17px 25px !important
    }

    .btn-primary {
      position: relative;
      overflow: hidden
    }

    .btn-primary:before {
      content: "";
      position: absolute;
      inset: -2px;
      background: linear-gradient(110deg, transparent 25%, rgba(255, 255, 255, .35) 45%, transparent 65%);
      transform: translateX(-100%);
      animation: shine 3.5s infinite
    }

    @keyframes shine {

      55%,
      100% {
        transform: translateX(100%)
      }
    }

    .hero3d {
      perspective: 1800px !important
    }

    .hero-anime-wrap {
      border-radius: 42px !important;
      transform: rotateY(-7deg) rotateX(4deg) !important
    }

    .hero-anime-wrap:hover {
      transform: rotateY(0deg) rotateX(0deg) scale(1.025) !important
    }

    .hero-anime {
      border-radius: 38px !important;
      box-shadow: 35px 35px 0 rgba(99, 91, 255, .08), 0 45px 100px rgba(37, 50, 110, .28) !important
    }

    .hero-orbit {
      inset: -15% !important;
      border-width: 2px !important
    }

    section {
      padding: 125px 0 !important
    }

    .section-head {
      margin-bottom: 60px !important
    }

    h2 {
      font-size: clamp(48px, 5vw, 76px) !important
    }

    .profile {
      border-radius: 42px !important;
      transform: rotate(-4deg) !important;
      border: 8px solid rgba(255, 255, 255, .7)
    }

    .profile:before {
      content: "";
      position: absolute;
      inset: 0;
      z-index: 3;
      background: linear-gradient(145deg, rgba(255, 255, 255, .22), transparent 35%);
      pointer-events: none
    }

    .stats {
      gap: 18px !important
    }

    .stat {
      border-radius: 22px !important;
      padding: 22px !important;
      transition: .35s !important
    }

    .stat:hover {
      transform: translateY(-8px) rotate(-1deg);
      border-color: rgba(99, 91, 255, .25) !important
    }

    .skills {
      gap: 22px !important
    }

    .skill {
      min-height: 285px !important;
      border-radius: 32px !important;
      padding: 34px !important;
      background: linear-gradient(145deg, #fff, #f1f4ff) !important
    }

    .skill:nth-child(odd) {
      transform: translateY(22px)
    }

    .skill:hover {
      transform: translateY(-10px) rotateX(4deg) rotateY(-4deg) !important
    }

    .skill .icon {
      width: 72px !important;
      height: 72px !important;
      font-size: 32px !important
    }

    .services {
      gap: 26px !important
    }

    .service-card {
      min-height: 350px !important;
      border-radius: 38px !important;
      padding: 40px !important
    }

    .service-card:nth-child(even) {
      transform: translateY(45px)
    }

    .service-card:hover {
      transform: translateY(-12px) rotateX(5deg) rotateY(-4deg) !important
    }

    .projects {
      gap: 32px !important
    }

    .project {
      border-radius: 38px !important;
      min-height: 460px !important
    }

    .project:nth-child(1) {
      min-height: 540px !important
    }

    .project:before {
      background: linear-gradient(to top, rgba(5, 8, 25, .98), rgba(5, 8, 25, .72) 45%, rgba(5, 8, 25, .05)) !important
    }

    .project-content {
      padding-bottom: 12px
    }

    .project h3 {
      font-size: 32px !important
    }

    .price {
      border-radius: 34px !important;
      padding: 38px !important
    }

    .price.featured {
      background: linear-gradient(160deg, #fff, #efefff) !important
    }

    .journey {
      margin-top: 25px !important
    }

    .jitem {
      padding-bottom: 60px !important
    }

    .contact {
      border-radius: 48px !important;
      background: linear-gradient(135deg, #101426, #1d2150) !important;
      box-shadow: 0 35px 100px rgba(24, 28, 70, .22)
    }

    .contact:before {
      content: "";
      position: absolute;
      width: 500px;
      height: 500px;
      border-radius: 50%;
      left: -250px;
      bottom: -300px;
      background: radial-gradient(circle, rgba(0, 184, 255, .30), transparent 68%)
    }

    footer {
      padding: 45px 0 !important
    }

    /* New visual separator */
    .premium-marquee {
      overflow: hidden;
      padding: 28px 0;
      background: #11162b;
      color: #fff;
      transform: rotate(-1.2deg) scale(1.03);
      margin: 40px 0
    }

    .premium-track {
      display: flex;
      gap: 55px;
      width: max-content;
      animation: marquee 24s linear infinite;
      white-space: nowrap;
      font: 700 20px "Space Grotesk";
      letter-spacing: 1px
    }

    .premium-track span {
      color: #b8c0ff
    }

    @keyframes marquee {
      to {
        transform: translateX(-50%)
      }
    }

    @media(max-width:900px) {
      .hero h1 {
        font-size: clamp(55px, 12vw, 78px) !important
      }

      .hero-anime-wrap {
        transform: none !important
      }

      .skill:nth-child(odd),
      .service-card:nth-child(even) {
        transform: none
      }

      section {
        padding: 90px 0 !important
      }
    }
  </style>


  <style id="ultimate-redesign">
    :root {
      --glass: rgba(255, 255, 255, .68);
      --glass-line: rgba(99, 91, 255, .13);
      --dark-bg: #090d1d;
      --dark-surface: #11172d;
      --dark-text: #f5f7ff;
      --dark-muted: #aab4cc;
    }

    .nav-tools {
      display: flex;
      align-items: center;
      gap: 10px
    }

    .theme-toggle {
      width: 42px;
      height: 42px;
      border: 1px solid var(--line);
      border-radius: 14px;
      background: rgba(255, 255, 255, .75);
      color: var(--ink);
      cursor: pointer;
      display: grid;
      place-items: center;
      font-size: 18px;
      transition: .3s;
    }

    .theme-toggle:hover {
      transform: translateY(-3px) rotate(-8deg);
      box-shadow: 0 10px 25px rgba(50, 60, 120, .12)
    }

    .trust-strip {
      padding: 25px 0 !important;
      position: relative;
      z-index: 2
    }

    .trust-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 12px;
      padding: 12px;
      border: 1px solid var(--glass-line);
      border-radius: 24px;
      background: var(--glass);
      backdrop-filter: blur(18px);
      box-shadow: 0 18px 55px rgba(40, 50, 100, .08);
    }

    .trust-grid>div {
      padding: 18px 22px;
      border-right: 1px solid var(--line)
    }

    .trust-grid>div:last-child {
      border-right: 0
    }

    .trust-grid strong {
      display: block;
      font: 700 30px "Space Grotesk";
      color: var(--blue)
    }

    .trust-grid span {
      font-size: 12px;
      color: var(--muted)
    }

    .process-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px
    }

    .process-card {
      position: relative;
      min-height: 285px;
      padding: 30px;
      border-radius: 30px;
      background: linear-gradient(145deg, #fff, #f0f3ff);
      border: 1px solid rgba(99, 91, 255, .12);
      overflow: hidden;
      transition: .4s;
      box-shadow: 0 16px 45px rgba(35, 50, 80, .06)
    }

    .process-card:hover {
      transform: translateY(-10px) rotateX(4deg);
      box-shadow: 0 30px 75px rgba(45, 55, 120, .14)
    }

    .process-card>span {
      position: absolute;
      right: 22px;
      top: 18px;
      font: 700 12px "Space Grotesk";
      color: var(--blue);
      letter-spacing: 2px
    }

    .process-card:after {
      content: "";
      position: absolute;
      width: 170px;
      height: 170px;
      right: -85px;
      bottom: -90px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(99, 91, 255, .22), transparent 70%);
    }

    .process-icon {
      width: 58px;
      height: 58px;
      border-radius: 18px;
      display: grid;
      place-items: center;
      background: linear-gradient(145deg, #fff, #e9e8ff);
      box-shadow: 0 12px 28px rgba(65, 60, 160, .12);
      font-size: 25px;
      color: var(--blue);
      margin-bottom: 45px
    }

    .process-card h3 {
      font: 700 23px "Space Grotesk";
      margin-bottom: 10px
    }

    .process-card p {
      font-size: 13px;
      line-height: 1.75;
      color: var(--muted)
    }

    .back-top {
      position: fixed;
      right: 25px;
      bottom: 25px;
      width: 48px;
      height: 48px;
      border: 1px solid var(--glass-line);
      border-radius: 16px;
      background: rgba(255, 255, 255, .82);
      backdrop-filter: blur(14px);
      color: var(--ink);
      z-index: 9990;
      cursor: pointer;
      opacity: 0;
      visibility: hidden;
      transform: translateY(15px);
      transition: .35s;
      box-shadow: 0 15px 35px rgba(30, 40, 90, .12)
    }

    .back-top.show {
      opacity: 1;
      visibility: visible;
      transform: none
    }

    body.dark {
      --bg: #080c19;
      --surface: #10162a;
      --ink: #f5f7ff;
      --muted: #aab4cc;
      --line: #252d45;
      --glass: rgba(17, 23, 45, .70);
      --glass-line: rgba(120, 130, 255, .18)
    }

    body.dark #animated-bg {
      background:
        linear-gradient(rgba(109, 93, 252, .045) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 184, 255, .035) 1px, transparent 1px),
        rgba(8, 12, 25, .92);
      background-size: 65px 65px;
    }

    body.dark header {
      background: rgba(8, 12, 25, .70) !important;
      border-bottom-color: rgba(120, 130, 255, .14) !important
    }

    body.dark .navlinks {
      color: #aeb8d0
    }

    body.dark .theme-toggle {
      background: rgba(20, 27, 50, .9);
      color: #fff
    }

    body.dark .eyebrow,
    body.dark .btn-secondary,
    body.dark .stat,
    body.dark .skill,
    body.dark .service,
    body.dark .service-card,
    body.dark .price,
    body.dark .process-card {
      background: linear-gradient(145deg, #11172d, #151d36) !important;
      color: #f5f7ff;
      border-color: #28304b
    }

    body.dark .profile {
      background: linear-gradient(145deg, #1b2142, #101b35)
    }

    body.dark .profile .badge {
      background: #11172d;
      color: #fff
    }

    body.dark .skill p,
    body.dark .service p,
    body.dark .service-card p,
    body.dark .price p,
    body.dark .price li,
    body.dark .lead,
    body.dark .about-copy p,
    body.dark .process-card p {
      color: #aab4cc
    }

    body.dark .premium-marquee {
      background: #050817
    }

    body.dark .contact {
      box-shadow: 0 35px 100px rgba(0, 0, 0, .35)
    }

    body.dark footer {
      border-color: #252d45
    }

    body.dark .back-top {
      background: rgba(17, 23, 45, .88);
      color: #fff
    }

    @media(max-width:900px) {

      .trust-grid,
      .process-grid {
        grid-template-columns: repeat(2, 1fr)
      }

      .trust-grid>div:nth-child(2) {
        border-right: 0
      }

      .trust-grid>div {
        border-bottom: 1px solid var(--line)
      }

      .trust-grid>div:nth-child(n+3) {
        border-bottom: 0
      }
    }

    @media(max-width:650px) {
      .nav-tools .navcta {
        display: none
      }

      .trust-grid,
      .process-grid {
        grid-template-columns: 1fr
      }

      .trust-grid>div {
        border-right: 0;
        border-bottom: 1px solid var(--line) !important
      }

      .trust-grid>div:last-child {
        border-bottom: 0 !important
      }

      .process-card {
        min-height: 250px
      }

      .back-top {
        right: 16px;
        bottom: 16px
      }
    }

    @media(prefers-reduced-motion:reduce) {

      .premium-track,
      .btn-primary:before {
        animation: none !important
      }

      .process-card,
      .theme-toggle {
        transition: none
      }
    }
  </style>


  <style id="ultra-polish">
    /* ===== ULTRA POLISH — CONTENT PRESERVED ===== */
    :root {
      --ultra-border: rgba(99, 91, 255, .13);
      --ultra-glow: rgba(99, 91, 255, .22);
    }

    body {
      scrollbar-width: thin;
      scrollbar-color: #8b84ff transparent
    }

    ::selection {
      background: rgba(99, 91, 255, .22);
      color: inherit
    }

    header {
      transition: background .35s, box-shadow .35s, transform .35s
    }

    header.nav-hidden {
      transform: translateY(-100%)
    }

    .navlinks a {
      position: relative;
      padding: 8px 0
    }

    .navlinks a:after {
      content: "";
      position: absolute;
      left: 0;
      right: 100%;
      bottom: 2px;
      height: 2px;
      border-radius: 10px;
      background: linear-gradient(90deg, var(--blue), var(--cyan));
      transition: .3s
    }

    .navlinks a:hover:after,
    .navlinks a.active:after {
      right: 0
    }

    .navlinks a.active {
      color: var(--blue)
    }

    .hero .eyebrow {
      animation: softPulse 3s ease-in-out infinite
    }

    @keyframes softPulse {
      50% {
        box-shadow: 0 12px 38px rgba(99, 91, 255, .16)
      }
    }

    .hero p {
      max-width: 690px
    }

    .actions .btn {
      box-shadow: 0 12px 30px rgba(30, 40, 90, .06)
    }

    .btn-secondary:hover {
      border-color: rgba(99, 91, 255, .3) !important;
      box-shadow: 0 15px 35px rgba(70, 70, 150, .10)
    }

    .section-head .lead {
      position: relative;
      padding-left: 18px
    }

    .section-head .lead:before {
      content: "";
      position: absolute;
      left: 0;
      top: 7px;
      width: 3px;
      height: calc(100% - 14px);
      border-radius: 5px;
      background: linear-gradient(var(--blue), var(--cyan))
    }

    .trust-grid {
      box-shadow: 0 22px 65px rgba(40, 50, 100, .10), inset 0 1px #fff
    }

    .trust-grid strong {
      letter-spacing: -1px
    }

    .skill,
    .service-card,
    .process-card,
    .price,
    .stat {
      backdrop-filter: blur(10px)
    }

    .skill,
    .service-card,
    .process-card,
    .price {
      box-shadow: 0 18px 55px rgba(35, 50, 90, .065)
    }

    .skill:hover,
    .service-card:hover,
    .process-card:hover,
    .price:hover {
      box-shadow: 0 30px 85px rgba(40, 50, 110, .13)
    }

    .skill .icon,
    .service-icon,
    .process-icon {
      position: relative;
      overflow: hidden
    }

    .skill .icon:after,
    .service-icon:after,
    .process-icon:after {
      content: "";
      position: absolute;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(255, 255, 255, .85), transparent 68%);
      left: -45px;
      top: -45px;
      opacity: .7
    }

    .project {
      isolation: isolate
    }

    .project-content {
      transition: transform .45s ease
    }

    .project:hover .project-content {
      transform: translateZ(55px) translateY(-5px)
    }

    .project-tag {
      box-shadow: inset 0 1px rgba(255, 255, 255, .25)
    }

    .project a {
      box-shadow: inset 0 1px rgba(255, 255, 255, .18), 0 8px 22px rgba(0, 0, 0, .10)
    }

    .price {
      transition: transform .35s, box-shadow .35s, border-color .35s
    }

    .price:not(.featured):hover {
      transform: translateY(-10px)
    }

    .price.featured {
      position: relative
    }

    .price.featured:before {
      content: "";
      position: absolute;
      inset: -1px;
      border-radius: inherit;
      padding: 1px;
      background: linear-gradient(120deg, var(--blue), var(--cyan), var(--violet));
      -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
      -webkit-mask-composite: xor;
      mask-composite: exclude;
      pointer-events: none;
      opacity: .65
    }

    .jitem {
      transition: transform .35s
    }

    .jitem:hover {
      transform: translateX(8px)
    }

    .jitem:before {
      transition: .3s
    }

    .jitem:hover:before {
      transform: scale(1.45);
      box-shadow: 0 0 28px rgba(99, 91, 255, .75)
    }

    .contact {
      box-shadow: 0 40px 110px rgba(24, 28, 70, .20)
    }

    input,
    textarea {
      transition: border-color .25s, box-shadow .25s, background .25s
    }

    input:focus,
    textarea:focus {
      border-color: rgba(120, 140, 255, .75);
      background: rgba(255, 255, 255, .10);
      box-shadow: 0 0 0 4px rgba(99, 91, 255, .10)
    }

    .send {
      position: relative;
      overflow: hidden;
      transition: .3s !important
    }

    .send:hover {
      transform: translateY(-4px);
      box-shadow: 0 18px 40px rgba(99, 91, 255, .25)
    }

    .send:after {
      content: "";
      position: absolute;
      top: 0;
      bottom: 0;
      width: 90px;
      left: -120px;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .28), transparent);
      transform: skewX(-18deg);
      animation: buttonSweep 4s infinite
    }

    @keyframes buttonSweep {

      0%,
      55% {
        left: -120px
      }

      75%,
      100% {
        left: 110%
      }
    }

    footer .social a {
      transition: .25s
    }

    footer .social a:hover {
      transform: translateY(-3px)
    }

    #bg-obstacles {
      opacity: .82
    }

    .bg-obstacle {
      filter: drop-shadow(0 12px 28px rgba(70, 80, 170, .14))
    }

    #particles {
      opacity: .8
    }

    /* Elegant section separators */
    section:not(.hero):after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 50%;
      width: min(1180px, 90%);
      height: 1px;
      transform: translateX(-50%);
      background: linear-gradient(90deg, transparent, rgba(99, 91, 255, .12), transparent);
    }

    /* Scroll reveal stagger */
    .reveal:nth-child(2) {
      transition-delay: .05s
    }

    .reveal:nth-child(3) {
      transition-delay: .10s
    }

    .reveal:nth-child(4) {
      transition-delay: .15s
    }

    .reveal:nth-child(5) {
      transition-delay: .20s
    }

    .reveal:nth-child(6) {
      transition-delay: .25s
    }

    .reveal:nth-child(7) {
      transition-delay: .30s
    }

    .reveal:nth-child(8) {
      transition-delay: .35s
    }

    /* Floating ambient light */
    .ambient-orb {
      position: fixed;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      pointer-events: none;
      z-index: -2;
      background: radial-gradient(circle, rgba(99, 91, 255, .08), transparent 68%);
      filter: blur(10px);
      transition: transform 1.2s cubic-bezier(.2, .8, .2, 1)
    }

    @media(max-width:650px) {
      header.nav-hidden {
        transform: none
      }

      .section-head .lead {
        padding-left: 0
      }

      .section-head .lead:before {
        display: none
      }

      section:not(.hero):after {
        width: 82%
      }

      .reveal:nth-child(n) {
        transition-delay: 0s
      }
    }

    @media(prefers-reduced-motion:reduce) {

      *,
      *:before,
      *:after {
        animation-duration: .01ms !important;
        animation-iteration-count: 1 !important;
        scroll-behavior: auto !important
      }
    }
  </style>


  <style id="loader-style">
    .page-loader {
      position: fixed;
      inset: 0;
      z-index: 10050;
      background: #080c19;
      color: #fff;
      display: grid;
      place-items: center;
      align-content: center;
      gap: 22px;
      transition: opacity .65s, visibility .65s
    }

    .page-loader.done {
      opacity: 0;
      visibility: hidden;
      pointer-events: none
    }

    .loader-mark {
      font: 700 42px "Space Grotesk";
      letter-spacing: -3px
    }

    .loader-mark span {
      color: #6d5dfc
    }

    .loader-line {
      width: 130px;
      height: 2px;
      background: rgba(255, 255, 255, .12);
      overflow: hidden;
      border-radius: 5px
    }

    .loader-line i {
      display: block;
      width: 45%;
      height: 100%;
      background: linear-gradient(90deg, #635bff, #00b8ff);
      animation: loader 1.1s ease-in-out infinite
    }

    @keyframes loader {
      50% {
        transform: translateX(190%)
      }
    }
  </style>

</head>

<body>

  <div class="ambient-orb" id="ambientOrb" aria-hidden="true"></div>
  <div class="page-loader" id="pageLoader" aria-hidden="true">
    <div class="loader-mark">M<span>.</span></div>
    <div class="loader-line"><i></i></div>
  </div>

  <div id="animated-bg"></div>
  <div id="bg-obstacles" aria-hidden="true"></div>
  <div id="particles"></div>
  <div class="cursor-light" id="cursorLight"></div>
  <div class="scroll-progress" id="scrollProgress"></div>
  <div class="cursor-dot" id="cursorDot"></div>
  <div class="cursor-ring" id="cursorRing"></div>
  <div class="cursor-label" id="cursorLabel">VIEW</div>
  <button class="back-top" id="backTop" aria-label="Back to top">↑</button>


  <header>
    <div class="container nav">
      <a class="logo" href="#home">Mayank<span>.</span></a>
      <div class="navlinks" id="navlinks">
        <a href="#home">Home</a><a href="#about">About</a><a href="#skills">Skills</a>
        <a href="#services">Services</a><a href="#projects">Projects</a><a href="#pricing">Pricing</a><a href="#process">Process</a><a href="#contact">Contact</a>
      </div>
      <div class="nav-tools"><button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">☾</button><a class="navcta magnetic" href="#contact">Let's Talk ↗</a></div>
      <div class="menu" onclick="document.getElementById('navlinks').classList.toggle('open')">☰</div>
    </div>
  </header>

  <main>
    <section class="hero container" id="home">
      <div class="reveal">
        <div class="eyebrow"><span class="dot"></span> Available for freelance projects</div>
        <h1>I Build <span class="gradient">Digital Experiences</span> That Grow Brands.</h1>
        <p>I'm Mayank Garg — Freelancer, Digital Marketer & Web Developer. I create modern websites, digital strategies, visual identities and AI-powered solutions that help businesses stand out online.</p>
        <div class="actions"><a class="btn btn-primary magnetic" href="#projects">View My Work →</a><a class="btn btn-secondary magnetic" href="#contact">Start a Project</a></div>
      </div>
      <div class="hero3d reveal" id="hero3d">
        <div class="hero-anime-wrap" id="heroAnime">
          <div class="hero-orbit"></div>
          <div class="anime-glow"></div>
          <img class="hero-anime" src="hero.png" alt="Mayank Garg futuristic anime developer hero">
          <div class="anime-scan"></div>
          <div class="anime-float anime-float-1">✦ 10+ PROJECTS</div>
          <div class="anime-float anime-float-2">AI • WEB • MARKETING</div>
        </div>
      </div>
    </section>


    <div class="premium-marquee" aria-hidden="true">
      <div class="premium-track">
        <span>WEB DEVELOPMENT ✦</span><span>SEO & MARKETING ✦</span><span>AI SOLUTIONS ✦</span><span>CREATIVE DESIGN ✦</span><span>WEB DEVELOPMENT ✦</span><span>SEO & MARKETING ✦</span><span>AI SOLUTIONS ✦</span><span>CREATIVE DESIGN ✦</span>
      </div>
    </div>

    <section class="trust-strip" aria-label="Capabilities">
      <div class="container trust-grid">
        <div><strong>50+</strong><span>Digital Projects</span></div>
        <div><strong>8+</strong><span>Happy Clients</span></div>
        <div><strong>4+</strong><span>Core Services</span></div>
        <div><strong>100%</strong><span>Custom Solutions</span></div>
      </div>
    </section>

    <section id="about">
      <div class="container about">
        <div class="profile reveal">
          <img src="aboutme.png" alt="Mayank Garg">
          <div class="badge">
            <b>Mayank Garg</b><br>
            <small>Digital Creator & Developer</small>
          </div>
        </div>
        <div class="about-copy reveal">
          <div class="kicker">01 / About Me</div>
          <h2>Turning ideas into <span class="gradient">digital growth.</span></h2>
          <p>I'm a multidisciplinary freelancer working across web development, digital marketing, design and emerging AI tools. My goal is simple: combine creativity with technology to build digital experiences that look premium and deliver real business value.</p>
          <div class="stats">
            <div class="stat"><b>10+</b><span>Projects</span></div>
            <div class="stat"><b>8+</b><span>Clients</span></div>
            <div class="stat"><b>10+</b><span>Skills</span></div>
            <div class="stat"><b>100%</b><span>Creative</span></div>
          </div>
        </div>
      </div>
    </section>

    <section id="skills">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <div class="kicker">02 / Expertise</div>
            <h2>Skills that make<br>ideas <span class="gradient">real.</span></h2>
          </div>
          <p class="lead">A practical mix of technology, marketing and creative skills to take a project from concept to launch.</p>
        </div>
        <div class="skills" id="skillCards">

          <div class="skill reveal">

            <div class="icon">💻</div>

            <h3>Web Development</h3>

            <p>
              Responsive business, portfolio, e-commerce
              and custom websites.
            </p>

            <div class="skill-line"></div>

          </div>


          <div class="skill reveal">

            <div class="icon">📈</div>

            <h3>Digital Marketing</h3>

            <p>
              SEO, social media, paid campaigns and
              growth-focused strategies.
            </p>

            <div class="skill-line"></div>

          </div>


          <div class="skill reveal">

            <div class="icon">🎨</div>

            <h3>Graphic Design</h3>

            <p>
              Branding, social creatives, posters,
              logos and visual systems.
            </p>

            <div class="skill-line"></div>

          </div>


          <div class="skill reveal">

            <div class="icon">🤖</div>

            <h3>AI & GenAI</h3>

            <p>
              AI-powered workflows, content creation
              and creative automation.
            </p>

            <div class="skill-line"></div>

          </div>

          <div class="skill reveal">
            <div class="icon">🎨</div>
            <h3>UI/UX Design</h3>
            <p>
              Clean, modern and user-friendly interfaces
              designed for better digital experiences.
            </p>
            <div class="skill-line"></div>
          </div>

          <div class="skill reveal">
            <div class="icon">🌐</div>
            <h3>WordPress Development</h3>
            <p>
              Professional WordPress websites with custom
              layouts, responsive design and easy management.
            </p>
            <div class="skill-line"></div>
          </div>

          <div class="skill reveal">
            <div class="icon">🛒</div>
            <h3>E-Commerce</h3>
            <p>
              Modern online stores with attractive product
              pages, smooth shopping experiences and conversions.
            </p>
            <div class="skill-line"></div>
          </div>

          <div class="skill reveal">
            <div class="icon">🚀</div>
            <h3>SEO &amp; Growth</h3>
            <p>
              Search optimization and growth strategies that
              help websites reach the right audience.
            </p>
            <div class="skill-line"></div>
          </div>

        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <div class="kicker">03 / Services</div>
            <h2>What I can do<br>for your <span class="gradient">business.</span></h2>
          </div>
        </div>

        <div class="services">

          <!-- CARD 01 -->
          <div class="service-card" data-number="01">
            <div class="service-icon">💻</div>
            <!-- <span class="service-number">01</span> -->



            <h3>Web Development</h3>

            <p>
              High-performance, responsive and modern websites
              designed to turn visitors into customers.
            </p>

            <div class="service-arrow">↗</div>
          </div>


          <!-- CARD 02 -->
          <div class="service-card" data-number="02">
            <div class="service-icon">📈</div>
            <!-- <span class="service-number">02</span> -->

            <h3>SEO & Marketing</h3>

            <p>
              Improve visibility, reach the right audience
              & turn digital attention into measurable growth.
            </p>

            <div class="service-arrow">↗</div>
          </div>


          <!-- CARD 03 -->
          <div class="service-card" data-number="03">
            <div class="service-icon">🎨</div>
            <!-- <span class="service-number">03</span> -->

            <h3>Social Media</h3>

            <p>
              Creative content, strategy and campaigns designed to
              build a consistent and memorable online presence.
            </p>

            <div class="service-arrow">↗</div>
          </div>


          <!-- CARD 04 -->
          <div class="service-card" data-number="04">
            <div class="service-icon">🤖</div>
            <!-- <span class="service-number">04</span> -->

            <h3>Brand & Creative</h3>

            <p>
              Logos, visual identity, graphics and creative direction
              that give your business a stronger personality.
            </p>

            <div class="service-arrow">↗</div>
          </div>

        </div>
      </div>
    </section>

    <section id="projects">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <div class="kicker">04 / Selected Work</div>
            <h2>Projects I'm<br><span class="gradient">proud of.</span></h2>
          </div>
          <p class="lead">A selection of websites, digital brands and creative projects. Replace these with your live project links whenever you're ready.</p>
        </div>
        <div class="projects">

          <!-- PROJECT 01 -->
          <div class="project reveal" data-tilt>

            <img
              class="project-image"
              src="smd.png"
              alt="SMD IIT Website">

            <div class="big">01</div>

            <div class="project-content">

              <span class="project-tag">
                Education Website
              </span>

              <h3>
                S.M.D Institute of Information Technology
              </h3>

              <p>
                Digital Learner • CCC • O Level
              </p>

              <a
                href="https://smdiit.in/"
                target="_blank">
                View Project ↗
              </a>

            </div>

          </div>


          <!-- PROJECT 02 -->
          <div class="project reveal" data-tilt>

            <img
              class="project-image"
              src="career.png"
              alt="Career Evolution">

            <div class="big">02</div>

            <div class="project-content">

              <span class="project-tag">
                EdTech
              </span>

              <h3>
                Career Evolution
              </h3>

              <p>
                EdTech • Website • Digital Growth
              </p>

              <a href="https://careerevolution.in/">
                View Project ↗
              </a>

            </div>

          </div>


          <!-- PROJECT 03 -->
          <div class="project reveal" data-tilt>

            <img
              class="project-image"
              src="pmi.png"
              alt="Positive Muslim India">

            <div class="big">03</div>

            <div class="project-content">

              <span class="project-tag">
                Foundation
              </span>

              <h3>
                Positive Muslim India
              </h3>

              <p>
                Foundation Website • Social Impact
              </p>

              <a href="https://positivemuslimindia.com/">
                View Project ↗
              </a>

            </div>

          </div>


          <!-- PROJECT 04 -->
          <div class="project reveal" data-tilt>

            <img
              class="project-image"
              src="puritz.png"
              alt="Puritz Chem">

            <div class="big">04</div>

            <div class="project-content">

              <span class="project-tag">
                Corporate
              </span>

              <h3>
                Puritz Chem
              </h3>

              <p>
                Corporate Website • Business Branding
              </p>

              <a href="https://www.puritzchem.com/">
                View Project ↗
              </a>

            </div>

          </div>


          <!-- PROJECT 05
    <div class="project reveal" data-tilt>

        <img
            class="project-image"
            src="img/projects/gemcart.jpg"
            alt="GEMCART"
        >

        <div class="big">05</div>

        <div class="project-content">

            <span class="project-tag">
                E-Commerce
            </span>

            <h3>
                GEMCART
            </h3>

            <p>
                Gaming Accessories • E-commerce Store
            </p>

            <a href="#">
                View Project ↗
            </a>

        </div>

    </div> -->

        </div>
      </div>


      <!-- PROJECT 04 -->
      <!-- <div class="project reveal" data-tilt>
    <img class="project-image"
         src="img/projects/puritz-chem.jpg"
         alt="Puritz Chem Project"
         loading="lazy">

    <div class="big">04</div>

    <div class="project-content">
      <span class="project-tag">Corporate</span>

      <h3>Puritz Chem</h3>

      <p>Corporate Website • Business Branding</p>

      <a href="#"
         target="_blank"
         rel="noopener">
        View Project ↗
      </a>
    </div>
  </div> -->


      <!-- PROJECT 05 -->
      <!-- <div class="project reveal" data-tilt>
    <img class="project-image"
         src="img/projects/gemcart.jpg"
         alt="GEMCART Project"
         loading="lazy">

    <div class="big">05</div>

    <div class="project-content">
      <span class="project-tag">E-Commerce</span>

      <h3>GEMCART</h3>

      <p>Gaming Accessories • E-commerce Store</p>

      <a href="#"
         target="_blank"
         rel="noopener">
        View Project ↗
      </a>
    </div>
  </div> -->

      </div>
      </div>
    </section>

    <section id="pricing">
      <div class="container">
        <div class="section-head reveal">
          <div>
            <div class="kicker">05 / Packages</div>
            <h2>Simple pricing.<br><span class="gradient">Serious results.</span></h2>
          </div>
        </div>
        <div class="pricing">
          <div class="price reveal" data-tilt>
            <h3>Starter</h3>
            <div class="amount">₹9,999</div>
            <p>For individuals and small businesses starting their digital journey.</p>
            <ul>
              <li>Landing / Basic Website</li>
              <li>Responsive Design</li>
              <li>Basic SEO Setup</li>
              <li>Contact Form</li>
            </ul><a class="btn btn-secondary magnetic" href="#contact">Get Started</a>
          </div>
          <div class="price featured reveal" data-tilt><span class="tag">POPULAR</span>
            <h3>Professional</h3>
            <div class="amount">₹19,999</div>
            <p>For businesses that need a stronger online presence and premium design.</p>
            <ul>
              <li>Multi-section Website</li>
              <li>Premium UI & Animations</li>
              <li>SEO Foundation</li>
              <li>Social Integration</li>
            </ul><a class="btn btn-primary magnetic" href="#contact">Choose Plan</a>
          </div>
          <div class="price reveal" data-tilt>
            <h3>Growth</h3>
            <div class="amount">Custom</div>
            <p>For brands looking for a complete digital strategy and ongoing growth.</p>
            <ul>
              <li>Website + Marketing</li>
              <li>SEO & Social Strategy</li>
              <li>Creative Content</li>
              <li>Ongoing Support</li>
            </ul><a class="btn btn-secondary magnetic" href="#contact">Let's Discuss</a>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="section-head reveal">
          <div>
            <div class="kicker">06 / Journey</div>
            <h2>My digital<br><span class="gradient">journey.</span></h2>
          </div>
        </div>
        <div class="journey">
          <div class="jitem reveal"><small>2024 — PRESENT</small>
            <h3>Freelance Web Developer & Social Media Manager</h3>
            <p>Developing responsive websites and managing client’s social media presence through effective digital marketing strategies.</p>
          </div>
          <div class="jitem reveal"><small>2025 — 2026</small>
            <h3>Career Evolution Edtech Institute</h3>
            <p>Trained students in Basic Computer, Tally, Advanced Excel, and Digital Marketing, while managing Career Evolution as its Founder.</p>
          </div>
          <div class="jitem reveal"><small>3 Months Intership</small>
            <h3>SEO & SMM Intern — Online Strikers</h3>
            <p>Gained hands-on experience in SEO and social media marketing while supporting content, optimization, and audience engagement activities.</p>
          </div>
          <div class="jitem reveal"><small>2021 — PRESENT</small>
            <h3>Video Editor</h3>
            <p>Creating engaging and professional video content using CapCut, Adobe Premiere Pro, and After Effects.</p>
          </div>
          <div class="jitem reveal"><small>2020-2021</small>
            <h3>Stock Market Trader</h3>
            <p>Developed practical expertise in stock market analysis, trading strategies, and investment management.</p>
          </div>
        </div>
      </div>

      <section id="process">
        <div class="container">
          <div class="section-head reveal">
            <div>
              <div class="kicker">06 / Process</div>
              <h2>A simple process.<br><span class="gradient">Better outcomes.</span></h2>
            </div>
            <p class="lead">From the first idea to launch and beyond, every project follows a clear, collaborative workflow.</p>
          </div>
          <div class="process-grid">
            <article class="process-card reveal"><span>01</span>
              <div class="process-icon">✦</div>
              <h3>Discover</h3>
              <p>Understand your goals, audience, competitors and the result the project needs to achieve.</p>
            </article>
            <article class="process-card reveal"><span>02</span>
              <div class="process-icon">◈</div>
              <h3>Design</h3>
              <p>Shape the visual direction, user experience and content structure into a premium concept.</p>
            </article>
            <article class="process-card reveal"><span>03</span>
              <div class="process-icon">⌁</div>
              <h3>Build</h3>
              <p>Develop a responsive, fast and polished digital experience with clean interactions.</p>
            </article>
            <article class="process-card reveal"><span>04</span>
              <div class="process-icon">↗</div>
              <h3>Launch & Grow</h3>
              <p>Launch confidently, measure what matters and keep improving the digital presence.</p>
            </article>
          </div>
        </div>
      </section>

      <section id="contact">
        <div class="container">
          <div class="contact reveal">
            <div>
              <div class="kicker">08 / Contact</div>
              <h2>Have an idea?<br>Let's make it <span class="gradient">real.</span></h2>
              <p>Tell me what you're building. Whether it's a website, brand, marketing campaign or something completely new — let's talk.</p>
            </div>
            <div class="form">
              <?php if ($messageStatus != ""): ?><div class="status"><?php echo $messageStatus; ?></div><?php endif; ?>
              <form method="POST">
                <div class="row"><input name="name" type="text" placeholder="Your Name" required><input name="email" type="email" placeholder="Email Address" required></div>
                <input name="subject" type="text" placeholder="Project Subject" required>
                <textarea name="message" placeholder="Tell me about your project..." required></textarea>
                <button class="send magnetic" name="send_message" type="submit">Send Message →</button>
              </form>
            </div>
          </div>
        </div>
      </section>
  </main>

  <footer>
    <div class="container foot">
      <div>© <?php echo date("Y"); ?> Mayank Garg. All rights reserved.</div>
      <div class="social"><a href="https://www.instagram.com/mynk_garg_6?igsi=NTlhdnVodDhmdTcz&utm_source=qr">Instagram</a><a href="#">LinkedIn</a><a href="#">GitHub</a><a href="#">WhatsApp</a></div>
    </div>
  </footer>

  <script>
    const reveals = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => entries.forEach(e => {
      if (e.isIntersecting) e.target.classList.add('show')
    }), {
      threshold: .12
    });
    reveals.forEach(x => io.observe(x));

    const particles = document.getElementById('particles');
    for (let i = 0; i < 45; i++) {
      const p = document.createElement('i');
      p.className = 'particle';
      p.style.left = Math.random() * 100 + '%';
      p.style.setProperty('--x', ((Math.random() - .5) * 180) + 'px');
      p.style.setProperty('--d', (9 + Math.random() * 16) + 's');
      p.style.animationDelay = (-Math.random() * 20) + 's';
      particles.appendChild(p);
    }

    const hero3d = document.getElementById('hero3d'),
      heroAnime = document.getElementById('heroAnime'),
      cursorLight = document.getElementById('cursorLight');
    let heroTargetX = 0,
      heroTargetY = 0,
      heroX = 0,
      heroY = 0;
    if (hero3d && heroAnime) {
      const moveHero = (e) => {
        const r = hero3d.getBoundingClientRect();
        heroTargetX = ((e.clientX - r.left) / r.width - .5);
        heroTargetY = ((e.clientY - r.top) / r.height - .5);
        heroAnime.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
        heroAnime.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
        hero3d.style.setProperty('--px', (heroTargetX * 70) + 'px');
        hero3d.style.setProperty('--py', (heroTargetY * 55) + 'px');
      };
      hero3d.addEventListener('mousemove', moveHero);
      hero3d.addEventListener('mouseleave', () => {
        heroTargetX = 0;
        heroTargetY = 0;
        heroAnime.style.setProperty('--mx', '50%');
        heroAnime.style.setProperty('--my', '50%');
      });
      const animateHero = () => {
        heroX += (heroTargetX - heroX) * .09;
        heroY += (heroTargetY - heroY) * .09;
        const autoX = Math.sin(performance.now() / 2600) * .025,
          autoY = Math.cos(performance.now() / 3100) * .018;
        const x = heroX + autoX,
          y = heroY + autoY;
        heroAnime.style.transform = `rotateX(${y*-10}deg) rotateY(${x*14}deg) translate3d(${x*18}px,${y*12}px,28px)`;
        requestAnimationFrame(animateHero);
      };
      animateHero();
    }

    if (cursorLight && matchMedia('(pointer:fine)').matches) {
      cursorLight.style.opacity = '.75';
      window.addEventListener('mousemove', e => {
        cursorLight.style.left = e.clientX + 'px';
        cursorLight.style.top = e.clientY + 'px';
      });
    }

    // Give every floating particle a subtle mouse reaction.
    window.addEventListener('mousemove', e => {
      const mx = e.clientX / innerWidth - .5,
        my = e.clientY / innerHeight - .5;
      document.querySelectorAll('.particle').forEach((p, i) => {
        if (i % 3 === 0) p.style.marginLeft = (mx * (i % 7 + 2)) + 'px';
        if (i % 4 === 0) p.style.marginTop = (my * (i % 6 + 2)) + 'px';
      });
    });
    window.addEventListener('mousemove', e => {
      const mx = e.clientX / innerWidth - .5,
        my = e.clientY / innerHeight - .5;

      document.querySelectorAll('.particle').forEach((p, i) => {
        if (i % 3 === 0) p.style.marginLeft = (mx * (i % 7 + 2)) + 'px';
        if (i % 4 === 0) p.style.marginTop = (my * (i % 6 + 2)) + 'px';
      });
    });


    document.querySelectorAll('.navlinks a').forEach(a =>
      a.addEventListener('click', () => {
        document.getElementById('navlinks').classList.remove('open')
      })
    );


    /* =========================================
       3D SKILLS MOUSE EFFECT
    ========================================= */

    document.querySelectorAll('.skill').forEach(card => {

      card.addEventListener('mousemove', function(e) {

        const rect = card.getBoundingClientRect();

        const x =
          (e.clientX - rect.left) /
          rect.width - 0.5;

        const y =
          (e.clientY - rect.top) /
          rect.height - 0.5;

        const rotateX = y * -12;
        const rotateY = x * 14;

        card.style.transform =
          `translateY(-10px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)
             scale3d(1.02,1.02,1.02)`;

        card.style.setProperty(
          '--sx',
          ((x + 0.5) * 100) + '%'
        );

        card.style.setProperty(
          '--sy',
          ((y + 0.5) * 100) + '%'
        );

      });


      card.addEventListener('mouseleave', function() {

        card.style.transform =
          'translateY(0) rotateX(0) rotateY(0) scale3d(1,1,1)';

        card.style.setProperty('--sx', '50%');
        card.style.setProperty('--sy', '50%');

      });

    });

    /* ===== ADVANCED MOUSE SYSTEM ===== */
    const cursorDot = document.getElementById('cursorDot');
    const cursorRing = document.getElementById('cursorRing');
    const cursorLabel = document.getElementById('cursorLabel');
    const scrollProgress = document.getElementById('scrollProgress');
    let mouseX = innerWidth / 2,
      mouseY = innerHeight / 2,
      ringX = mouseX,
      ringY = mouseY;
    if (matchMedia('(pointer:fine)').matches) {
      document.body.classList.add('cursor-active');
      window.addEventListener('mousemove', e => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        if (cursorDot) {
          cursorDot.style.left = mouseX + 'px';
          cursorDot.style.top = mouseY + 'px'
        }
      });
      const cursorLoop = () => {
        ringX += (mouseX - ringX) * .16;
        ringY += (mouseY - ringY) * .16;
        if (cursorRing) {
          cursorRing.style.left = ringX + 'px';
          cursorRing.style.top = ringY + 'px'
        }
        if (cursorLabel) {
          cursorLabel.style.left = ringX + 'px';
          cursorLabel.style.top = ringY + 'px'
        }
        requestAnimationFrame(cursorLoop);
      };
      cursorLoop();
      document.addEventListener('mousedown', () => cursorRing?.classList.add('click'));
      document.addEventListener('mouseup', () => cursorRing?.classList.remove('click'));
      document.querySelectorAll('a,button,[data-tilt]').forEach(el => {
        el.addEventListener('mouseenter', () => cursorRing?.classList.add('hover'));
        el.addEventListener('mouseleave', () => cursorRing?.classList.remove('hover'));
      });
      document.querySelectorAll('.project').forEach(el => {
        el.addEventListener('mouseenter', () => {
          if (cursorLabel) cursorLabel.textContent = 'OPEN'
        });
        el.addEventListener('mouseleave', () => {
          if (cursorLabel) cursorLabel.textContent = 'VIEW'
        });
      });
    }

    /* Scroll progress */
    const updateProgress = () => {
      const max = document.documentElement.scrollHeight - innerHeight;
      if (scrollProgress) scrollProgress.style.width = (max > 0 ? (scrollY / max) * 100 : 0) + '%';
    };
    addEventListener('scroll', updateProgress, {
      passive: true
    });
    updateProgress();

    /* Premium 3D card tilt + cursor light */
    if (matchMedia('(pointer:fine)').matches) {
      document.querySelectorAll('[data-tilt]').forEach(card => {
        card.addEventListener('mousemove', e => {
          const r = card.getBoundingClientRect();
          const x = (e.clientX - r.left) / r.width - .5,
            y = (e.clientY - r.top) / r.height - .5;
          const strength = card.classList.contains('project') ? 10 : 7;
          card.style.transform = `perspective(900px) rotateX(${-y*strength}deg) rotateY(${x*strength}deg) translateY(-6px)`;
          card.style.setProperty('--spot-x', (x + .5) * 100 + '%');
          card.style.setProperty('--spot-y', (y + .5) * 100 + '%');
        });
        card.addEventListener('mouseleave', () => card.style.transform = '');
      });
    }

    /* Magnetic buttons */
    if (matchMedia('(pointer:fine)').matches) {
      document.querySelectorAll('.magnetic').forEach(btn => {
        btn.addEventListener('mousemove', e => {
          const r = btn.getBoundingClientRect();
          const x = e.clientX - r.left - r.width / 2,
            y = e.clientY - r.top - r.height / 2;
          btn.style.transform = `translate(${x*.16}px,${y*.16}px)`;
        });
        btn.addEventListener('mouseleave', () => btn.style.transform = '');
      });
    }

    /* Keep hero mouse movement buttery */
    if (hero3d && heroAnime) {
      hero3d.addEventListener('mousemove', e => {
        const r = hero3d.getBoundingClientRect();
        const x = (e.clientX - r.left) / r.width - .5,
          y = (e.clientY - r.top) / r.height - .5;
        heroAnime.style.setProperty('--mx', (x + .5) * 100 + '%');
        heroAnime.style.setProperty('--my', (y + .5) * 100 + '%');
      });
    }


    /* ===== CREATE MOVING BACKGROUND OBSTACLES ===== */
    const obstacleLayer = document.getElementById('bg-obstacles');

    if (obstacleLayer) {
      const obstacleData = [
        ['circle', '8%', '18%', '58px', 'obstacleFloat1', '0s', '.55'],
        ['square', '22%', '72%', '42px', 'obstacleFloat2', '-4s', '.45'],
        ['diamond', '38%', '30%', '34px', 'obstacleFloat3', '-8s', '.50'],
        ['ring', '57%', '78%', '76px', 'obstacleFloat4', '-3s', '.38'],
        ['cross', '76%', '20%', '52px', 'obstacleFloat2', '-11s', '.40'],
        ['circle', '88%', '62%', '30px', 'obstacleFloat3', '-6s', '.55'],
        ['diamond', '68%', '48%', '44px', 'obstacleFloat1', '-13s', '.42'],
        ['ring', '13%', '48%', '88px', 'obstacleFloat4', '-9s', '.30'],
        ['square', '48%', '88%', '28px', 'obstacleFloat2', '-15s', '.38'],
        ['circle', '94%', '34%', '48px', 'obstacleFloat1', '-7s', '.36'],
        ['cross', '31%', '10%', '30px', 'obstacleFloat3', '-17s', '.32'],
        ['diamond', '4%', '84%', '38px', 'obstacleFloat2', '-5s', '.40']
      ];

      obstacleData.forEach(([type, left, top, size, animation, delay, opacity]) => {
        const el = document.createElement('span');
        el.className = `bg-obstacle ${type}`;
        el.style.setProperty('--left', left);
        el.style.setProperty('--top', top);
        el.style.setProperty('--size', size);
        el.style.setProperty('--opacity', opacity);
        el.style.animation = `${animation} ${11 + Math.random()*8}s ease-in-out infinite`;
        el.style.animationDelay = delay;
        obstacleLayer.appendChild(el);
      });

      // Subtle mouse parallax across the whole page.
      if (matchMedia('(pointer:fine)').matches) {
        let ox = 0,
          oy = 0,
          tx = 0,
          ty = 0;
        window.addEventListener('mousemove', e => {
          tx = (e.clientX / innerWidth - .5) * 24;
          ty = (e.clientY / innerHeight - .5) * 24;
        }, {
          passive: true
        });

        const obstacleParallax = () => {
          ox += (tx - ox) * .035;
          oy += (ty - oy) * .035;
          obstacleLayer.style.transform = `translate3d(${ox}px,${oy}px,0)`;
          requestAnimationFrame(obstacleParallax);
        };
        obstacleParallax();
      }
    }
    /* SERVICES 3D MOUSE EFFECT */

    document.querySelectorAll('.service-card').forEach(card => {

      card.addEventListener('mousemove', function(e) {

        const rect = card.getBoundingClientRect();

        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;

        const rotateX = y * -10;
        const rotateY = x * 12;

        card.style.transform =
          `translateY(-12px)
             rotateX(${rotateX}deg)
             rotateY(${rotateY}deg)
             scale(1.02)`;

      });

      card.addEventListener('mouseleave', function() {

        card.style.transform =
          'translateY(0) rotateX(0) rotateY(0) scale(1)';

      });

    });

    /* ===== ULTIMATE PORTFOLIO UX ===== */
    (() => {
      const themeToggle = document.getElementById('themeToggle');
      const savedTheme = localStorage.getItem('mayank-theme');
      const applyTheme = dark => {
        document.body.classList.toggle('dark', dark);
        if (themeToggle) themeToggle.textContent = dark ? '☀' : '☾';
      };
      applyTheme(savedTheme === 'dark');
      themeToggle?.addEventListener('click', () => {
        const dark = !document.body.classList.contains('dark');
        applyTheme(dark);
        localStorage.setItem('mayank-theme', dark ? 'dark' : 'light');
      });

      const backTop = document.getElementById('backTop');
      const updateBackTop = () => backTop?.classList.toggle('show', scrollY > 650);
      addEventListener('scroll', updateBackTop, {
        passive: true
      });
      updateBackTop();
      backTop?.addEventListener('click', () => scrollTo({
        top: 0,
        behavior: 'smooth'
      }));

      // Active section navigation
      const navItems = [...document.querySelectorAll('.navlinks a')];
      const sections = navItems.map(a => document.querySelector(a.getAttribute('href'))).filter(Boolean);
      const navObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            navItems.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + entry.target.id));
          }
        });
      }, {
        rootMargin: '-35% 0px -55% 0px',
        threshold: 0
      });
      sections.forEach(s => navObserver.observe(s));

      // Animate numeric trust metrics when they enter the viewport.
      document.querySelectorAll('.trust-grid strong').forEach(el => {
        const original = el.textContent.trim();
        if (!/^\d+\+?$|^100%$/.test(original)) return;
        const target = parseInt(original, 10);
        let started = false;
        const observer = new IntersectionObserver(entries => {
          if (!entries[0].isIntersecting || started) return;
          started = true;
          const suffix = original.includes('%') ? '%' : original.includes('+') ? '+' : '';
          const start = performance.now(),
            duration = 1000;
          const tick = now => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased) + suffix;
            if (p < 1) requestAnimationFrame(tick);
          };
          requestAnimationFrame(tick);
          observer.disconnect();
        }, {
          threshold: .5
        });
        observer.observe(el);
      });
    })();
  </script>

  <script>
    /* ===== ULTRA POLISH INTERACTIONS ===== */
    (() => {
      const loader = document.getElementById('pageLoader');
      const finishLoader = () => setTimeout(() => loader?.classList.add('done'), 350);
      if (document.readyState === 'complete') finishLoader();
      else window.addEventListener('load', finishLoader, {
        once: true
      });

      // Hide header while scrolling down, reveal while scrolling up.
      let lastY = scrollY;
      const header = document.querySelector('header');
      addEventListener('scroll', () => {
        const y = scrollY;
        if (y > 180 && y > lastY + 8) header?.classList.add('nav-hidden');
        else if (y < lastY - 8) header?.classList.remove('nav-hidden');
        if (y < 80) header?.classList.remove('nav-hidden');
        header?.classList.toggle('scrolled', y > 30);
        lastY = y;
      }, {
        passive: true
      });

      // Ambient light follows the pointer slowly.
      const orb = document.getElementById('ambientOrb');
      if (orb && matchMedia('(pointer:fine)').matches) {
        addEventListener('mousemove', e => {
          orb.style.transform = `translate3d(${e.clientX*.025}px,${e.clientY*.025}px,0)`;
        }, {
          passive: true
        });
      }

      // Add keyboard-friendly focus visibility.
      document.querySelectorAll('a,button,input,textarea').forEach(el => {
        el.addEventListener('focus', () => el.style.outline = '2px solid rgba(99,91,255,.55)');
        el.addEventListener('blur', () => el.style.outline = '');
      });
    })();
  </script>

</body>

</html>