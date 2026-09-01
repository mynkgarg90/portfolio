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

  <style>
    /* ===== IMAGE LIGHTBOX ===== */
    .ads-lightbox {
      position: fixed;
      inset: 0;
      z-index: 99999;
      display: none;
      align-items: center;
      justify-content: center;
      padding: 30px;
      background: rgba(5, 8, 18, .88);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .ads-lightbox.active {
      display: flex;
    }

    .ads-lightbox img {
      max-width: 94vw;
      max-height: 90vh;
      width: auto;
      height: auto;
      object-fit: contain;
      border-radius: 16px;
      box-shadow: 0 30px 100px rgba(0, 0, 0, .55);
      animation: adsZoom .3s ease;
    }

    @keyframes adsZoom {
      from {
        opacity: 0;
        transform: scale(.92);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .ads-lightbox-close {
      position: absolute;
      top: 22px;
      right: 28px;
      width: 44px;
      height: 44px;
      border: 1px solid rgba(255, 255, 255, .2);
      border-radius: 50%;
      background: rgba(255, 255, 255, .08);
      color: #fff;
      font-size: 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: .25s ease;
    }

    .ads-lightbox-close:hover {
      background: rgba(255, 255, 255, .18);
      transform: rotate(90deg);
    }

    .ads-shot {
      cursor: pointer;
    }

    .ads-shot img {
      cursor: zoom-in;
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

    /* ===== PERFORMANCE OPTIMIZATION ===== */
    section:not(.hero) {
      contain: layout paint
    }

    img {
      content-visibility: auto
    }

    .skill,
    .service-card,
    .project,
    .price,
    .profile,
    .hero-anime-wrap,
    .hero-anime,
    .cursor-dot,
    .cursor-ring,
    .cursor-light {
      backface-visibility: hidden;
      -webkit-backface-visibility: hidden
    }

    @media(max-width:900px), (prefers-reduced-motion:reduce) {

      .cursor-light,
      .cursor-dot,
      .cursor-ring,
      .cursor-label {
        display: none !important
      }

      .hero-orbit,
      .anime-scan,
      .anime-glow,
      .particle,
      .bg-obstacle,
      .float-card {
        animation: none !important
      }

      body::after {
        animation: none !important;
        filter: none !important
      }

      .reveal {
        filter: none !important;
        transition: opacity .45s ease, transform .45s ease !important
      }

      [data-tilt]>* {
        transform: none !important
      }
    }

    @media(max-width:650px) {
      header {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px)
      }

      .hero-anime-wrap {
        filter: drop-shadow(0 20px 35px rgba(20, 35, 90, .20))
      }
    }
  </style>

</head>

<body>
  <?php
  $adsProject = isset($_GET['project']) ? $_GET['project'] : '';

  if ($adsProject === 'google-ads' || $adsProject === 'meta-ads') {
    $isGoogle = $adsProject === 'google-ads';
    $title = $isGoogle ? 'Google Ads' : 'Meta Ads';
    $image = $isGoogle ? 'ads-google.jpg' : 'ads-meta.jpg';
    $slug = $isGoogle ? 'google' : 'meta';
    $platform = $isGoogle ? 'Google Search • PPC • Lead Generation' : 'Facebook • Instagram • Lead Generation';
    $description = $isGoogle
      ? 'Paid search campaigns designed to capture high-intent users, generate qualified leads and improve conversion efficiency.'
      : 'Paid social campaigns designed to reach the right audience, test creative and generate qualified leads.';
    $items = $isGoogle
      ? ['Keyword research & high-intent targeting', 'Campaign and ad-group structure', 'Conversion tracking & landing-page alignment', 'Bid, budget and search-term optimisation']
      : ['Audience research & targeting', 'Facebook and Instagram campaign setup', 'Creative testing & retargeting', 'Lead generation & performance optimisation'];
  ?>
    <style>
      /* ===== PORTFOLIO-NATIVE ADS PROJECT PAGE ===== */
      html {
        cursor: none
      }

      body.ads-project-body {
        margin: 0;
        min-height: 100vh;
        background:
          radial-gradient(circle at 15% 8%, rgba(99, 91, 255, .10), transparent 28%),
          radial-gradient(circle at 85% 28%, rgba(24, 160, 251, .08), transparent 30%),
          var(--bg);
        color: var(--ink);
      }

      .ads-page {
        width: min(1160px, 90%);
        margin: 0 auto;
        padding: 126px 0 90px;
        position: relative;
        z-index: 2;
      }

      .ads-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 48px;
      }

      .ads-mini {
        font: 700 10px "Space Grotesk";
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--muted);
      }

      .ads-mini:before {
        content: "";
        display: inline-block;
        width: 22px;
        height: 1px;
        margin: 0 9px 3px 0;
        background: linear-gradient(90deg, var(--blue), var(--purple));
      }

      .ads-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--ink);
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 14px;
        border: 1px solid var(--line);
        background: rgba(255, 255, 255, .72);
        border-radius: 999px;
        box-shadow: 0 10px 30px rgba(28, 38, 65, .06);
        transition: .25s ease;
      }

      .ads-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(28, 38, 65, .10)
      }

      .ads-head {
        display: grid;
        grid-template-columns: 1fr .52fr;
        gap: 55px;
        align-items: end;
        margin-bottom: 34px;
      }

      .ads-title {
        margin: 0;
        font: 700 clamp(50px, 7vw, 82px)/.93 "Space Grotesk";
        letter-spacing: -4.5px;
      }

      .ads-gradient {
        background: linear-gradient(100deg, var(--blue), var(--cyan), var(--purple));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
      }

      .ads-desc {
        margin: 0;
        color: var(--muted);
        font-size: 15px;
        line-height: 1.85;
      }

      .ads-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 22px
      }

      .ads-tag {
        padding: 7px 11px;
        border: 1px solid var(--line);
        border-radius: 999px;
        background: rgba(255, 255, 255, .7);
        color: var(--muted);
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1.1px;
        text-transform: uppercase;
      }

      .ads-hero {
        display: grid;
        grid-template-columns: 1.48fr .72fr;
        gap: 18px;
      }

      .ads-cover {
        min-height: 460px;
        position: relative;
        overflow: hidden;
        border-radius: 30px;
        border: 1px solid var(--line);
        background: #eef2fb;
        box-shadow: var(--shadow);
      }

      .ads-cover:before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 1;
        pointer-events: none;
        background: linear-gradient(135deg, rgba(99, 91, 255, .15), transparent 45%, rgba(24, 160, 251, .10));
      }

      .ads-cover:after {
        content: "";
        position: absolute;
        left: 8%;
        right: 8%;
        bottom: 0;
        height: 2px;
        z-index: 2;
        background: linear-gradient(90deg, transparent, var(--blue), var(--cyan), var(--purple), transparent);
      }

      .ads-cover img {
        display: block;
        width: 100%;
        height: 460px;
        object-fit: cover;
        transition: transform .7s ease;
      }

      .ads-cover:hover img {
        transform: scale(1.025)
      }

      .ads-fallback {
        height: 460px;
        display: grid;
        place-items: center;
        text-align: center;
        color: var(--ink);
        font: 700 27px "Space Grotesk";
        background: radial-gradient(circle at 50% 30%, rgba(99, 91, 255, .16), transparent 48%), #eef2fb;
      }

      .ads-side {
        min-height: 460px;
        padding: 28px;
        border-radius: 30px;
        border: 1px solid var(--line);
        background: rgba(255, 255, 255, .75);
        box-shadow: var(--shadow);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }

      .ads-side-label {
        font: 700 9px "Space Grotesk";
        letter-spacing: 2.4px;
        text-transform: uppercase;
        color: #9aa3b5;
      }

      .ads-side h2 {
        margin: 12px 0 8px;
        font: 700 39px/1 "Space Grotesk";
        letter-spacing: -2px;
      }

      .ads-side p {
        margin: 0;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.75
      }

      .ads-platform {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 17px;
        font-size: 11px;
        font-weight: 700;
        color: var(--ink);
      }

      .ads-platform i {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: block;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        box-shadow: 0 0 13px rgba(99, 91, 255, .45);
      }

      .ads-metrics {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
        margin-top: 28px
      }

      .ads-metric {
        padding: 15px;
        border-radius: 15px;
        background: #f7f8fc;
        border: 1px solid var(--line);
      }

      .ads-metric b {
        display: block;
        font: 700 15px "Space Grotesk";
        margin-bottom: 4px
      }

      .ads-metric span {
        font-size: 8px;
        letter-spacing: 1.2px;
        text-transform: uppercase;
        color: #9aa3b5
      }

      .ads-section {
        margin-top: 62px
      }

      .ads-section-head {
        margin-bottom: 20px
      }

      .ads-section-head small {
        font: 700 9px "Space Grotesk";
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #9aa3b5;
      }

      .ads-section-head h2 {
        margin: 8px 0 0;
        font: 700 clamp(33px, 5vw, 51px)/1 "Space Grotesk";
        letter-spacing: -2.5px;
      }

      .ads-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px
      }

      .ads-card {
        min-height: 195px;
        padding: 27px;
        border-radius: 23px;
        background: rgba(255, 255, 255, .76);
        border: 1px solid var(--line);
        box-shadow: 0 15px 55px rgba(28, 38, 65, .055);
        transition: .3s ease;
        position: relative;
        overflow: hidden;
      }

      .ads-card:after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        right: -90px;
        bottom: -90px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(99, 91, 255, .13), transparent 70%);
      }

      .ads-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 65px rgba(28, 38, 65, .10)
      }

      .ads-card-num {
        font: 700 9px "Space Grotesk";
        letter-spacing: 2px;
        color: var(--blue);
      }

      .ads-card h3 {
        margin: 11px 0 9px;
        font: 700 23px "Space Grotesk";
        letter-spacing: -.7px
      }

      .ads-card p,
      .ads-card li {
        color: var(--muted);
        font-size: 12px;
        line-height: 1.8
      }

      .ads-card ul {
        margin: 0;
        padding-left: 18px
      }

      .ads-card li+li {
        margin-top: 4px
      }

      .ads-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
      }

      .ads-shot {
        border-radius: 21px;
        overflow: hidden;
        border: 1px solid var(--line);
        background: #f1f3f9;
        box-shadow: 0 15px 50px rgba(28, 38, 65, .055);
      }

      .ads-shot img {
        display: block;
        width: 100%;
        height: 285px;
        object-fit: cover;
        transition: .55s ease
      }

      .ads-shot:hover img {
        transform: scale(1.035)
      }

      .ads-shot-fallback {
        height: 285px;
        display: grid;
        place-items: center;
        color: #9aa3b5;
        font-size: 11px;
        background: linear-gradient(145deg, #f8f9fc, #eef1f8);
      }

      .ads-cta {
        margin-top: 58px;
        padding: 27px 29px;
        border-radius: 24px;
        background: linear-gradient(135deg, rgba(99, 91, 255, .07), rgba(24, 160, 251, .06));
        border: 1px solid rgba(99, 91, 255, .14);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
      }

      .ads-cta h3 {
        margin: 0 0 5px;
        font: 700 24px "Space Grotesk";
        letter-spacing: -.7px
      }

      .ads-cta p {
        margin: 0;
        color: var(--muted);
        font-size: 12px
      }

      .ads-cta a {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
        padding: 12px 18px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        box-shadow: 0 12px 28px rgba(99, 91, 255, .2);
        transition: .25s ease;
      }

      .ads-cta a:hover {
        transform: translateY(-3px)
      }

      /* Keep the portfolio cursor working on this early-exit page. */
      .ads-cursor-dot,
      .ads-cursor-ring,
      .ads-cursor-light {
        position: fixed;
        pointer-events: none;
        left: 0;
        top: 0;
        transform: translate(-50%, -50%);
      }

      .ads-cursor-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 14px #18a0fb, 0 0 30px #635bff;
        z-index: 10003;
        mix-blend-mode: difference
      }

      .ads-cursor-ring {
        width: 38px;
        height: 38px;
        border: 1px solid rgba(99, 91, 255, .85);
        border-radius: 50%;
        z-index: 10002;
        mix-blend-mode: difference;
        transition: .2s ease
      }

      .ads-cursor-ring.hover {
        width: 70px;
        height: 70px;
        border-color: rgba(24, 160, 251, .9);
        background: rgba(24, 160, 251, .08)
      }

      .ads-cursor-light {
        width: 220px;
        height: 220px;
        border-radius: 50%;
        z-index: 9999;
        background: radial-gradient(circle, rgba(99, 91, 255, .13), rgba(24, 160, 251, .05) 35%, transparent 70%);
        mix-blend-mode: multiply;
        opacity: .9
      }

      @media(max-width:900px) {
        html {
          cursor: auto
        }

        .ads-cursor-dot,
        .ads-cursor-ring,
        .ads-cursor-light {
          display: none
        }

        .ads-head {
          grid-template-columns: 1fr;
          gap: 18px
        }

        .ads-hero {
          grid-template-columns: 1fr
        }

        .ads-cover,
        .ads-side {
          min-height: 390px
        }

        .ads-cover img,
        .ads-fallback {
          height: 390px
        }
      }

      @media(max-width:650px) {
        .ads-page {
          width: 92%;
          padding-top: 105px
        }

        .ads-title {
          font-size: 48px;
          letter-spacing: -3px
        }

        .ads-nav {
          margin-bottom: 34px
        }

        .ads-grid,
        .ads-gallery {
          grid-template-columns: 1fr
        }

        .ads-cover,
        .ads-side {
          min-height: 285px;
          border-radius: 22px
        }

        .ads-cover img,
        .ads-fallback {
          height: 285px
        }

        .ads-side {
          padding: 22px;
          min-height: 350px
        }

        .ads-side h2 {
          font-size: 33px
        }

        .ads-card {
          min-height: 0;
          padding: 22px
        }

        .ads-shot img,
        .ads-shot-fallback {
          height: 230px
        }

        .ads-cta {
          align-items: flex-start;
          flex-direction: column
        }

        .ads-cta a {
          width: 100%;
          justify-content: center
        }
      }
    </style>

    <body class="ads-project-body">
      <div class="ads-page">

        <div class="ads-nav">
          <div class="ads-mini">Selected Work / <?php echo $isGoogle ? '05' : '06'; ?></div>
          <a class="ads-back" href="index.php#projects">← Back to Projects</a>
        </div>

        <div class="ads-head">
          <div>
            <h1 class="ads-title"><?php echo htmlspecialchars($title); ?> <span class="ads-gradient">Campaign.</span></h1>
            <div class="ads-tags">
              <?php
              $badges = $isGoogle
                ? ['Google Search', 'PPC', 'Lead Generation', 'Conversion Tracking']
                : ['Facebook', 'Instagram', 'Audience Targeting', 'Retargeting'];
              foreach ($badges as $badge):
              ?>
                <span class="ads-tag"><?php echo htmlspecialchars($badge); ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <p class="ads-desc"><?php echo htmlspecialchars($description); ?> The page is structured as a clean campaign case study so visitors can understand the work without leaving your portfolio's visual system.</p>
        </div>

        <div class="ads-hero">
          <div class="ads-cover">
            <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($title); ?> campaign"
              onerror="this.style.display='none';this.nextElementSibling.style.display='grid';">
            <div class="ads-fallback" style="display:none"><?php echo htmlspecialchars($title); ?><br>Campaign Preview</div>
          </div>

          <aside class="ads-side">
            <div>
              <div class="ads-side-label">Project Overview</div>
              <h2><?php echo htmlspecialchars($title); ?></h2>
              <p><?php echo $isGoogle
                    ? 'High-intent paid search built around the right keywords, strong messaging and conversion-focused optimisation.'
                    : 'Paid social built around audience insight, creative testing, retargeting and conversion-focused optimisation.'; ?></p>
              <span class="ads-platform"><i></i><?php echo htmlspecialchars($platform); ?></span>
            </div>

            <div class="ads-metrics">
              <div class="ads-metric"><b><?php echo $isGoogle ? 'PPC' : 'Social'; ?></b><span>Campaign Type</span></div>
              <div class="ads-metric"><b>Leads</b><span>Primary Goal</span></div>
              <div class="ads-metric"><b>Testing</b><span>Optimisation</span></div>
              <div class="ads-metric"><b>ROI</b><span>KPI</span></div>
            </div>
          </aside>
        </div>

        <div class="ads-section">
          <div class="ads-section-head">
            <small>Campaign Breakdown</small>
            <h2>Strategy → execution → <span class="ads-gradient">growth.</span></h2>
          </div>

          <div class="ads-grid">
            <article class="ads-card">
              <div class="ads-card-num">01 / STRATEGY</div>
              <h3>Campaign Strategy</h3>
              <p>Clear targeting, campaign structure and creative direction built around the business objective, audience intent and conversion journey.</p>
            </article>

            <article class="ads-card">
              <div class="ads-card-num">02 / EXECUTION</div>
              <h3>What Was Managed</h3>
              <ul>
                <?php foreach ($items as $item): ?>
                  <li><?php echo htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
              </ul>
            </article>

            <article class="ads-card">
              <div class="ads-card-num">03 / CREATIVE</div>
              <h3>Creative & Messaging</h3>
              <p>Headlines, descriptions, creatives and calls-to-action are shaped around the audience stage, offer and campaign objective.</p>
            </article>

            <article class="ads-card">
              <div class="ads-card-num">04 / RESULTS</div>
              <h3>Performance Details</h3>
              <p>Add verified campaign results here — leads, CTR, conversions, CPA, ROAS, reach or any other meaningful KPI.</p>
            </article>
          </div>
        </div>

        <div class="ads-section">
          <div class="ads-section-head">
            <small>Campaign Gallery</small>
            <h2>Visuals & <span class="ads-gradient">details.</span></h2>
          </div>

          <div class="ads-gallery">
            <?php for ($i = 1; $i <= 3; $i++): ?>
              <div class="ads-shot">
                <img src="ads-<?php echo $slug; ?>-<?php echo $i; ?>.png"
                  alt="<?php echo htmlspecialchars($title); ?> screenshot <?php echo $i; ?>"
                  onerror="this.style.display='none';this.nextElementSibling.style.display='grid';">
                <div class="ads-shot-fallback" style="display:none">Add Image 0<?php echo $i; ?></div>
              </div>
            <?php endfor; ?>
          </div>
        </div>

        <div class="ads-cta">
          <div>
            <h3>Ready for the next campaign?</h3>
            <p>Let's build a focused advertising strategy around your next growth goal.</p>
          </div>
          <a href="index.php#contact">Start a Project ↗</a>
        </div>

      </div>

      <!-- Same portfolio cursor experience, available before this branch exits. -->
      <div class="ads-cursor-light" id="adsCursorLight"></div>
      <div class="ads-cursor-dot" id="adsCursorDot"></div>
      <div class="ads-cursor-ring" id="adsCursorRing"></div>

      <script>
        (() => {
          const dot = document.getElementById('adsCursorDot');
          const ring = document.getElementById('adsCursorRing');
          const light = document.getElementById('adsCursorLight');
          const fine = window.matchMedia('(pointer:fine)').matches;
          if (!fine) return;
          let x = innerWidth / 2,
            y = innerHeight / 2,
            rx = x,
            ry = y;
          addEventListener('pointermove', e => {
            x = e.clientX;
            y = e.clientY;
          }, {
            passive: true
          });
          document.querySelectorAll('a,button,.ads-card,.ads-cover,.ads-shot').forEach(el => {
            el.addEventListener('pointerenter', () => ring.classList.add('hover'));
            el.addEventListener('pointerleave', () => ring.classList.remove('hover'));
          });
          document.addEventListener('mousedown', () => ring.classList.add('click'));
          document.addEventListener('mouseup', () => ring.classList.remove('click'));

          function frame() {
            rx += (x - rx) * .16;
            ry += (y - ry) * .16;
            dot.style.left = x + 'px';
            dot.style.top = y + 'px';
            ring.style.left = rx + 'px';
            ring.style.top = ry + 'px';
            light.style.left = x + 'px';
            light.style.top = y + 'px';
            requestAnimationFrame(frame);
          }
          frame();
        })();
      </script>
    <?php
    exit;
  }
    ?>

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
            <img fetchpriority="high" decoding="async" class="hero-anime" src="hero.png" alt="Mayank Garg futuristic anime developer hero">
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
            <img loading="lazy" decoding="async" src="aboutme.png" alt="Mayank Garg">
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

      <!-- ===== IMAGE LIGHTBOX ===== -->
<div class="ads-lightbox" id="adsLightbox">

  <button class="ads-lightbox-close" id="adsLightboxClose">
    ×
  </button>

  <img id="adsLightboxImage" src="" alt="Campaign Preview">

</div>

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


            <!-- PROJECT 05 -->
            <a href="?project=google-ads" class="project reveal" data-tilt style="display:block;color:inherit;text-decoration:none;">
              <img class="project-image" src="googleadspreview.png" alt="Google Ads Campaign">
              <div class="big">05</div>
              <div class="project-content">
                <span class="project-tag">Paid Advertising</span>
                <h3>Google Ads</h3>
                <p>Search Ads • PPC • Lead Generation</p>
                <span class="project-link">View Project ↗</span>
              </div>
            </a>

            <!-- PROJECT 06 -->
            <a href="?project=meta-ads" class="project reveal" data-tilt style="display:block;color:inherit;text-decoration:none;">
              <img class="project-image" src="ads-meta.jpg" alt="Meta Ads Campaign">
              <div class="big">06</div>
              <div class="project-content">
                <span class="project-tag">Paid Social</span>
                <h3>Meta Ads</h3>
                <p>Facebook • Instagram • Lead Generation</p>
                <span class="project-link">View Project ↗</span>
              </div>
            </a>

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
        <div class="social"><a href="https://www.instagram.com/mynk_garg_6?igsi=NTlhdnVodDhmdTcz&utm_source=qr">Instagram</a>
          <a href="https://www.linkedin.com/in/mayank-garg90/">LinkedIn</a>
          <a href="#">GitHub</a>
          <a href="#">WhatsApp</a>
        </div>
      </div>
    </footer>

    <script>
      (() => {
        const fine = matchMedia('(pointer:fine)').matches;
        const $ = s => document.querySelector(s),
          $$ = s => [...document.querySelectorAll(s)];

        /* Reveal */
        const reveals = $$('.reveal');
        if ('IntersectionObserver' in window) {
          const ro = new IntersectionObserver(es => es.forEach(e => {
            if (e.isIntersecting) {
              e.target.classList.add('show');
              ro.unobserve(e.target)
            }
          }), {
            threshold: .08,
            rootMargin: '0px 0px -6% 0px'
          });
          reveals.forEach(x => ro.observe(x));
        } else reveals.forEach(x => x.classList.add('show'));

        /* Particles: fewer on smaller screens, no mouse DOM loop */
        const particles = $('#particles');
        if (particles) {
          const n = innerWidth < 650 ? 18 : innerWidth < 1000 ? 28 : 36,
            f = document.createDocumentFragment();
          for (let i = 0; i < n; i++) {
            const p = document.createElement('i');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.setProperty('--x', ((Math.random() - .5) * 180) + 'px');
            p.style.setProperty('--d', (9 + Math.random() * 16) + 's');
            p.style.animationDelay = (-Math.random() * 20) + 's';
            f.appendChild(p);
          }
          particles.appendChild(f);
        }

        /* Hero */
        const hero = $('#hero3d'),
          heroImg = $('#heroAnime');
        let hx = 0,
          hy = 0,
          tx = 0,
          ty = 0,
          heroVisible = true;
        if (hero && heroImg && fine) {
          hero.addEventListener('pointermove', e => {
            const r = hero.getBoundingClientRect();
            tx = (e.clientX - r.left) / r.width - .5;
            ty = (e.clientY - r.top) / r.height - .5;
            heroImg.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
            heroImg.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
          }, {
            passive: true
          });
          hero.addEventListener('pointerleave', () => {
            tx = ty = 0;
            heroImg.style.setProperty('--mx', '50%');
            heroImg.style.setProperty('--my', '50%')
          });
          if ('IntersectionObserver' in window) {
            const hi = new IntersectionObserver(e => heroVisible = e[0].isIntersecting, {
              threshold: 0
            });
            hi.observe(hero);
          }
        }

        /* Cursor */
        const dot = $('#cursorDot'),
          ring = $('#cursorRing'),
          label = $('#cursorLabel'),
          light = $('#cursorLight');
        let mx = innerWidth / 2,
          my = innerHeight / 2,
          rx = mx,
          ry = my,
          dirty = false;
        if (fine) {
          document.body.classList.add('cursor-active');
          addEventListener('pointermove', e => {
            mx = e.clientX;
            my = e.clientY;
            dirty = true
          }, {
            passive: true
          });
          document.addEventListener('mousedown', () => ring?.classList.add('click'));
          document.addEventListener('mouseup', () => ring?.classList.remove('click'));
          $$('a,button,[data-tilt]').forEach(el => {
            el.addEventListener('pointerenter', () => ring?.classList.add('hover'));
            el.addEventListener('pointerleave', () => ring?.classList.remove('hover'));
          });
          $$('.project').forEach(el => {
            el.addEventListener('pointerenter', () => {
              if (label) label.textContent = 'OPEN'
            });
            el.addEventListener('pointerleave', () => {
              if (label) label.textContent = 'VIEW'
            });
          });
        }

        /* Card tilt: lighter and only while hovered */
        if (fine) $$('.skill,.service-card,[data-tilt]').forEach(card => {
          let r = null;
          card.addEventListener('pointerenter', () => r = card.getBoundingClientRect(), {
            passive: true
          });
          card.addEventListener('pointermove', e => {
            if (!r) r = card.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width - .5,
              y = (e.clientY - r.top) / r.height - .5;
            const strength = card.classList.contains('project') ? 7 : card.classList.contains('skill') ? 7 : 6;
            card.style.transform = `perspective(900px) rotateX(${-y*strength}deg) rotateY(${x*strength}deg) translateY(-5px) scale3d(1.01,1.01,1.01)`;
            card.style.setProperty('--sx', ((x + .5) * 100) + '%');
            card.style.setProperty('--sy', ((y + .5) * 100) + '%');
          }, {
            passive: true
          });
          card.addEventListener('pointerleave', () => {
            card.style.transform = '';
            card.style.setProperty('--sx', '50%');
            card.style.setProperty('--sy', '50%');
            r = null;
          }, {
            passive: true
          });
        });

        /* Magnetic buttons */
        if (fine) $$('.magnetic').forEach(btn => {
          let r = null;
          btn.addEventListener('pointerenter', () => r = btn.getBoundingClientRect(), {
            passive: true
          });
          btn.addEventListener('pointermove', e => {
            if (!r) r = btn.getBoundingClientRect();
            const x = e.clientX - r.left - r.width / 2,
              y = e.clientY - r.top - r.height / 2;
            btn.style.transform = `translate(${x*.10}px,${y*.10}px)`;
          }, {
            passive: true
          });
          btn.addEventListener('pointerleave', () => {
            btn.style.transform = '';
            r = null
          }, {
            passive: true
          });
        });

        /* Scroll UI: one passive listener + one RAF */
        const progress = $('#scrollProgress'),
          back = $('#backTop'),
          header = $('header');
        let lastY = scrollY,
          ticking = false;
        const scrollUI = () => {
          const y = scrollY,
            max = document.documentElement.scrollHeight - innerHeight;
          if (progress) progress.style.width = (max > 0 ? y / max * 100 : 0) + '%';
          if (back) back.classList.toggle('show', y > 650);
          if (header) {
            if (y > 180 && y > lastY + 8) header.classList.add('nav-hidden');
            else if (y < lastY - 8 || y < 80) header.classList.remove('nav-hidden');
            header.classList.toggle('scrolled', y > 30);
          }
          lastY = y;
          ticking = false;
        };
        addEventListener('scroll', () => {
          if (!ticking) {
            ticking = true;
            requestAnimationFrame(scrollUI)
          }
        }, {
          passive: true
        });
        scrollUI();
        back?.addEventListener('click', () => scrollTo({
          top: 0,
          behavior: 'smooth'
        }));

        /* Mobile nav */
        $$('.navlinks a').forEach(a => a.addEventListener('click', () => $('#navlinks')?.classList.remove('open')));

        /* Active navigation */
        const nav = $$('.navlinks a'),
          secs = nav.map(a => $(a.getAttribute('href'))).filter(Boolean);
        if ('IntersectionObserver' in window) {
          const ni = new IntersectionObserver(es => es.forEach(e => {
            if (e.isIntersecting) nav.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + e.target.id));
          }), {
            rootMargin: '-35% 0px -55% 0px'
          });
          secs.forEach(s => ni.observe(s));
        }

        /* Theme */
        const toggle = $('#themeToggle'),
          saved = localStorage.getItem('mayank-theme');
        const theme = d => {
          document.body.classList.toggle('dark', d);
          if (toggle) toggle.textContent = d ? '☀' : '☾'
        };
        theme(saved === 'dark');
        toggle?.addEventListener('click', () => {
          const d = !document.body.classList.contains('dark');
          theme(d);
          localStorage.setItem('mayank-theme', d)
        });

        /* Trust counters */
        $$('.trust-grid strong').forEach(el => {
          const original = el.textContent.trim();
          if (!/^\d+\+?$|^100%$/.test(original)) return;
          const target = parseInt(original, 10),
            suffix = original.includes('%') ? '%' : original.includes('+') ? '+' : '';
          let done = false;
          const run = () => {
            if (done) return;
            done = true;
            const t = performance.now();
            const tick = n => {
              const p = Math.min((n - t) / 750, 1),
                e = 1 - Math.pow(1 - p, 3);
              el.textContent = Math.round(target * e) + suffix;
              if (p < 1) requestAnimationFrame(tick)
            };
            requestAnimationFrame(tick);
          };
          if ('IntersectionObserver' in window) {
            const ci = new IntersectionObserver(es => {
              if (es[0].isIntersecting) {
                run();
                ci.disconnect()
              }
            }, {
              threshold: .4
            });
            ci.observe(el)
          } else run();
        });

        /* Single animation frame for cursor + hero only */
        const frame = now => {
          if (fine) {
            if (dot && dirty) dot.style.transform = `translate3d(${mx}px,${my}px,0) translate(-50%,-50%)`;
            if (ring) {
              rx += (mx - rx) * .18;
              ry += (my - ry) * .18;
              ring.style.transform = `translate3d(${rx}px,${ry}px,0) translate(-50%,-50%)`;
              if (label) label.style.transform = `translate3d(${rx}px,${ry}px,0) translate(-50%,-50%)`
            }
            if (light && dirty) light.style.transform = `translate3d(${mx}px,${my}px,0) translate(-50%,-50%)`;
            dirty = false;
          }
          if (heroImg && heroVisible && fine) {
            hx += (tx - hx) * .08;
            hy += (ty - hy) * .08;
            const x = hx + Math.sin(now / 2600) * .018,
              y = hy + Math.cos(now / 3100) * .014;
            heroImg.style.transform = `rotateX(${y*-8}deg) rotateY(${x*10}deg) translate3d(${x*12}px,${y*8}px,22px)`;
          }
          requestAnimationFrame(frame);
        };
        requestAnimationFrame(frame);

        /* Loader */
        const loader = $('#pageLoader'),
          finish = () => setTimeout(() => loader?.classList.add('done'), 200);
        if (document.readyState === 'complete') finish();
        else addEventListener('load', finish, {
          once: true
        });
      })();
    </script>

    <script>
const adsLightbox = document.getElementById('adsLightbox');
const adsLightboxImage = document.getElementById('adsLightboxImage');
const adsLightboxClose = document.getElementById('adsLightboxClose');

document.querySelectorAll('.ads-shot img').forEach(img => {

  img.addEventListener('click', function(){

    adsLightboxImage.src = this.src;
    adsLightboxImage.alt = this.alt;

    adsLightbox.classList.add('active');

    document.body.style.overflow = 'hidden';

  });

});

function closeAdsLightbox(){

  adsLightbox.classList.remove('active');

  document.body.style.overflow = '';

  setTimeout(() => {
    adsLightboxImage.src = '';
  }, 250);

}

adsLightboxClose.addEventListener('click', closeAdsLightbox);

adsLightbox.addEventListener('click', function(e){

  if(e.target === adsLightbox){
    closeAdsLightbox();
  }

});

document.addEventListener('keydown', function(e){

  if(e.key === 'Escape'){
    closeAdsLightbox();
  }

});
</script>

    </body>

</html>