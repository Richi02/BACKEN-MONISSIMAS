<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Fuse React - Material design admin template with pre-built apps and pages">
    <meta name="keywords" content="React,Redux,Material UI Next,Material,Material Design,Google Material Design,HTML,CSS,Firebase,Authentication,Material Redux Theme,Material Redux Template">
    <meta name="author" content="Withinpixels">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <base href="/">
    <link href="assets/base.css" rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="assets/Material.css" rel="stylesheet">
    <link href="/assets/inter.css" rel="stylesheet">
    <link href="<?= base_url('assets/style.css');?>"  rel="stylesheet"><noscript id="emotion-insertion-point"></noscript>
    <title>Fuse React - Material Design Admin Template</title>
   


    
    <div class="flex flex-col flex-auto items-center sm:justify-center min-w-0">
    <div class="w-full sm:w-auto py-8 px-4 sm:p-12 sm:rounded-2xl sm:shadow sm:bg-card">
        <div class="w-full max-w-80 sm:w-80 mx-auto sm:mx-0">
            <!-- Logo -->
            <div class="w-12">
                <img src="assets/images/logo/logo.svg">
            </div>

            <!-- Title -->
            <div class="mt-8 text-4xl font-extrabold tracking-tight leading-tight">Sign in</div>
            <div class="flex items-baseline mt-0.5 font-medium">
                <div>Don't have an account?</div>
                <a
                    class="ml-1 text-primary-500 hover:underline"
                    [routerLink]="['/sign-up']">Sign up
                </a>
            </div>

            <!-- Alert -->
            <fuse-alert
                class="mt-8 -mb-4"
                *ngIf="showAlert"
                [appearance]="'outline'"
                [showIcon]="false"
                [type]="alert.type"
                [@shake]="alert.type === 'error'">
                {{alert.message}}
            </fuse-alert>

            <!-- Sign in form -->
            <form
                class="mt-8"
                [formGroup]="signInForm"
                #signInNgForm="ngForm">

                <!-- Email field -->
                <mat-form-field class="w-full">
                    <mat-label>Email address</mat-label>
                    <input
                        id="email"
                        matInput
                        [formControlName]="'email'">
                    <mat-error *ngIf="signInForm.get('email').hasError('required')">
                        Email address is required
                    </mat-error>
                    <mat-error *ngIf="signInForm.get('email').hasError('email')">
                        Please enter a valid email address
                    </mat-error>
                </mat-form-field>

                <!-- Password field -->
                <mat-form-field class="w-full">
                    <mat-label>Password</mat-label>
                    <input
                        id="password"
                        matInput
                        type="password"
                        [formControlName]="'password'"
                        #passwordField>
                    <button
                        mat-icon-button
                        type="button"
                        (click)="passwordField.type === 'password' ? passwordField.type = 'text' : passwordField.type = 'password'"
                        matSuffix>
                        <mat-icon
                            class="icon-size-5"
                            *ngIf="passwordField.type === 'password'"
                            [svgIcon]="'heroicons_solid:eye'"></mat-icon>
                        <mat-icon
                            class="icon-size-5"
                            *ngIf="passwordField.type === 'text'"
                            [svgIcon]="'heroicons_solid:eye-off'"></mat-icon>
                    </button>
                    <mat-error>
                        Password is required
                    </mat-error>
                </mat-form-field>

                <!-- Actions -->
                <div class="inline-flex items-end justify-between w-full mt-1.5">
                    <mat-checkbox
                        [color]="'primary'"
                        [formControlName]="'rememberMe'">
                        Remember me
                    </mat-checkbox>
                    <a
                        class="text-md font-medium text-primary-500 hover:underline"
                        [routerLink]="['/forgot-password']">Forgot password?
                    </a>
                </div>

                <!-- Submit button -->
                <button
                    class="fuse-mat-button-large w-full mt-6"
                    mat-flat-button
                    [color]="'primary'"
                    [disabled]="signInForm.disabled"
                    (click)="signIn()">
                    <span *ngIf="!signInForm.disabled">
                        Sign in
                    </span>
                    <mat-progress-spinner
                        *ngIf="signInForm.disabled"
                        [diameter]="24"
                        [mode]="'indeterminate'"></mat-progress-spinner>
                </button>

                <!-- Separator -->
                <div class="flex items-center mt-8">
                    <div class="flex-auto mt-px border-t"></div>
                    <div class="mx-2 text-secondary">Or continue with</div>
                    <div class="flex-auto mt-px border-t"></div>
                </div>

                <!-- Single sign-on buttons -->
                <div class="flex items-center mt-8 space-x-4">
                    <button
                        class="flex-auto"
                        type="button"
                        mat-stroked-button>
                        <mat-icon
                            class="icon-size-5"
                            [svgIcon]="'feather:facebook'"></mat-icon>
                    </button>
                    <button
                        class="flex-auto"
                        type="button"
                        mat-stroked-button>
                        <mat-icon
                            class="icon-size-5"
                            [svgIcon]="'feather:twitter'"></mat-icon>
                    </button>
                    <button
                        class="flex-auto"
                        type="button"
                        mat-stroked-button>
                        <mat-icon
                            class="icon-size-5"
                            [svgIcon]="'feather:github'"></mat-icon>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




    <script defer="defer" src="assets/main.js"></script>
    <link href="assets/main.css" rel="stylesheet">
</head>

<body><noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root" class="flex">
        <div id="fuse-splash-screen">
            <div class="logo"><img width="128" src="assets/images/logo/logo.svg" alt="logo"></div>
            <div id="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
</body>

</html>