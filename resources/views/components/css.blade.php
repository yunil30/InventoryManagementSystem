<!-- This is the header section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- This is axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<!-- Add Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<!-- Add jQuery and DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<!-- This is fpm -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
<!-- This is fontawesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<!-- Notyf CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<!-- Chosen CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<style>
    body {
        background-color: #e5f3fc;
        margin: 0;
        height: 100vh;
        display: grid;
        grid-template-columns: 14rem 1fr;
        grid-template-rows: 3.5rem 1fr auto;
        grid-template-areas: 
            "header header"
            "sidebar main"
            "footer footer";
        transition: all 1s ease;
        padding-right: 0 !important;
    }

    header {
        grid-area: header;
        background-color: #ffffff;
        box-shadow: 0px 1px 5px #00000047;
        padding: 0.5rem 2rem 0.5rem 1.2rem;
        position: sticky;
        display: flex;
        justify-content: space-between; 
        align-items: center;
        z-index: 10;

        .logo {
            display: flex;
            align-items: center;

            a {
                text-decoration: none; 
                color: #1f2328;
                font-size: 1.5rem;
                font-weight: 600;
                letter-spacing: .5px;
                /* text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8); */

                i {
                    margin-right: 8px;
                }
            }
        }
    
        .dropdown {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-left: auto;

            #usernameToggle {
                color: #1f2328;
                font-size: 25px;
                font-weight: 400;
                letter-spacing: .5px;
                text-decoration: none;

                &:hover {
                    color: #0d6efd;
                }

                &:active {
                    font-size: 22px;
                    color: #0d6efd;
                }
            }

            .dropdownOptions {
                display: none;
                position: absolute;
                right: 0;
                top: 100%;
                transform: translateY(5%);
                background-color: #ffffff;
                border: 1px solid rgb(215, 215, 215);
                box-shadow: 0px 1px 5px #00000047;
                padding: 0;
                width: max-content;

                #userFullname {
                    color: #1f2328;
                    font-size: 14.4px;
                    font-weight: 500;
                    letter-spacing: .5px;
                    border-bottom: 1.5px solid rgb(215, 215, 215);
                    padding: 1rem 1.5rem;
                    width: 100%;

                    i {
                        margin-right: .5rem;
                    }
                }

                a {
                    color: #1f2328;
                    font-size: 14.4px;
                    font-weight: 500;
                    letter-spacing: .5px;
                    text-decoration: none;
                    padding: 1rem 1.5rem;
                    display: flex;
                    justify-content: flex-start;
                    align-items: center;

                    &:hover {
                        border: 1px solid #0d6efd;
                        color: #0d6efd;
                    }

                    &:active {
                        font-size: 13px;
                        color: #0d6efd;
                    }

                    i {
                        margin-right: .5rem;
                    }
                }
            }
        }
    }

    aside {
        grid-area: sidebar;
        background-color: #ffffff;
        border-right: 1px solid rgb(215, 215, 215);
        padding: 2rem 0rem;

        .menu-list {
            padding: 0;

            .menu-item {
                font-size: 14.4px;
                font-weight: 500;
                letter-spacing: .5px;
                position: relative;

                a {     
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1.5rem 1rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    i:first-child {
                        margin-right: 10px;
                    }

                    i:last-child {
                        margin-left: auto;
                    }

                    &:hover {
                        /* background-color: #d5d8dc;*/
                        border: 1px solid #0d6efd;
                        color: #0d6efd;
                    }

                    &:active {
                        font-size: 13px;
                        color: #0d6efd;
                    }
                }

                .menu-toggle-icon {
                    font-size: 12px;
                    transition: transform 0.3s ease;
                }
            }

            .child-menu {
                padding: 0;
                display: none; 
                background-color: #f5f5f5;

                a {
                    display: block;
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1rem 1rem 3rem;

                    i:first-child {
                        margin-right: 10px;
                    }

                    &:hover {
                        /* background-color: #d5d8dc; */
                        border: 1px solid #0d6efd;
                        color: #0d6efd;
                    }

                    &:active {
                        font-size: 13px;
                        color: #0d6efd;
                    }
                }
            }
        }

        .menu-logout {
            padding: 0;
            
            .menu-item {
                font-size: 14.4px;
                font-weight: 500;
                letter-spacing: .5px;
                position: relative;

                a {     
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1.5rem 1rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    i:first-child {
                        margin-right: 10px;
                    }

                    i:last-child {
                        margin-left: auto;
                    }

                    &:hover {
                        /* background-color: #d5d8dc;*/
                        border: 1px solid #357edd;
                        color: #357edd;
                    }

                    &:active {
                        font-size: 13px;
                        color: #357edd;
                    }
                }
            }
        }
    }

    main {
        grid-area: main;
        padding: 2rem;
        z-index: 9;

        .main-content {
            background-color: #ffffff;
            border: 1px solid rgb(215, 215, 215);
            height: 100%;
            padding: 2rem 2rem 2rem 2rem;

            .content-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 7vh;
                
                h3 {
                    color: #1f2328;
                    font-size: 1.5rem;
                    font-weight: 600;
                    letter-spacing: .5px;
                    margin: 0;
                }

                button {
                    background-color: #0d6efd;
                    color: #ffffff;
                    font-size: 14px;
                    letter-spacing: .5px;
                    border-radius: 0px;
                    border: 1px solid #dee2e6;
                    padding: 10px 40px;
                    margin: 0px;

                    &:hover {
                        background-color: #0869fc;
                        color: #fff;
                        cursor: pointer;
                    }

                    &:active {
                        background-color: #0d6Efd;
                        transform: translateY(2px);
                    }
                }
            }

            .content-body {
                table {
                    th {
                        background-color: #0d6efd;
                        color: #ffffff;
                        font-size: 0.9rem;
                        font-weight: 500;
                        letter-spacing: .5px;
                    }

                    td {
                        background-color: #ffffff;
                        color: #1f2328;
                        font-size: 0.9rem;
                        font-weight: 400;
                        letter-spacing: .5px;

                        button:hover {
                            border: 1px solid ffffff;
                            color: #0d6Efd;
                        }

                        button:active {
                            color: #ffffff;
                            font-size: 0.8rem;
                        }
                    }
                }

                .dt-layout-row {
                    letter-spacing: .5px;

                    .dt-input {
                        color: #1f2328;
                        font-size: 14px;
                        letter-spacing: .5px;
                        border-radius: 0px;
                        border: 1px solid #dee2e6;
                        padding: 10px 15px;
                        box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.3);

                        &::placeholder {
                            font-size: 14px;
                            letter-spacing: .5px;
                            text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                            color: #8c8f92;
                        }

                        &:focus {
                            border-color: #0056c0;
                            font-size: 14px;
                            letter-spacing: .5px;
                            color: #1f2328;
                            outline: none;
                            box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8);
                        }
                    }

                    label{
                        margin-right: 0.5rem;
                        font-weight: 600;
                        font-size: 0.9rem;
                    }

                    input {
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                    }

                    .dt-info {
                        font-weight: 600;
                        font-size: 0.9rem;
                    }

                    .dt-paging {
                        font-weight: 600;
                        font-size: 0.9rem;
                    }
                }
            }

            .accountSettingDiv {
                letter-spacing: .5px;
                margin: 0;
                padding: 0;
                height: 100%;
                display: grid;
                grid-template-rows: 1fr 1fr auto;
                grid-template-areas: 
                    "accSettingDiv1"
                    "accSettingDiv2"
                    "accSettingDiv3";
                padding-right: 0 !important;
                                
                label {
                    font-size: 0.9rem;
                    font-weight: 500;
                    letter-spacing: .5px;
                    margin: 0px 0px 5px 0px;
                }

                input {
                    color: #1f2328;
                    font-size: 14px;
                    letter-spacing: .5px;
                    border-radius: 0px;
                    border: 1px solid #dee2e6;
                    padding: 10px 15px;
                    box-shadow: 0px 0px 1px rgba(23, 32, 42, 0.3);
                }

                .accHeadingDiv {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    h5 {
                        margin: 0;
                    }

                    .edit-button {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        background-color: white;
                        color: #1f2328;
                        box-shadow: 0px 1px 1px #00000035;
                        border: 1px solid rgb(215, 215, 215);
                        border-radius: 50px;
                        padding: 5px 18px;
                        font-size: 14px;
                        font-weight: 500;
                        cursor: pointer;
                        transition: background-color 0.3s, color 0.3s, border-color 0.3s;

                        i {
                            margin-right: 0.5rem; 
                        }
                    }

                    .edit-button:hover {
                        background-color: #f0f8ff;
                        border: 0.1px solid #0056b3;
                        color: #0056b3;
                    }
                }

                .accHeadingDescription {
                    color: #1f2328;
                    font-weight: 400;
                    font-size: 14px;
                    margin-bottom: 1rem;
                }

                .accSettingDiv1 {
                    background-color: #ffffff;
                    border: 1px solid rgb(215, 215, 215);
                    grid-area: accSettingDiv1;
                    padding: 1rem;
                }

                .accSettingDiv2 {
                    background-color: #ffffff;
                    border: 1px solid rgb(215, 215, 215);
                    grid-area: accSettingDiv2;
                    padding: 1rem;
                }

                .accSettingDiv3 {
                    background-color: #ffffff;
                    border: 1px solid rgb(215, 215, 215);
                    grid-area: accSettingDiv3;
                    padding: 1rem;
                }
            }
        }
    }

    footer {
        grid-area: footer;
        background-color: #ffffff;
        border: 1px solid rgb(215, 215, 215);
        text-align: center;
        z-index: 10;

        .copyrights {
            padding: 16px;

            p { 
                color: #1f2328;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: .5px;
                margin: 0;
            }
        }
    }

    .modal {
        letter-spacing: .5px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        .modal-content {
            border-radius: 3px;
        }

        .modal-header {
            padding: 15px 20px 5px 20px;
            display: flex;
            justify-content: space-between; 
            align-items: center;

            .modal-title {
                font-weight: 500;
            }
        }

        .modal-body {
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
            padding: 15px 20px 15px 20px;

            .modal-body::-webkit-scrollbar {
                width: 8px;
            }

            .modal-body::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 10px;
            }

            .modal-body::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }

            label {
                font-size: 0.9rem;
                font-weight: 500;
                letter-spacing: .5px;
                margin: 0px 0px 5px 0px;
            }

            input {
                color: #1f2328;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 15px;
                box-shadow: 0px 0px 1px rgba(23, 32, 42, 0.3);

                &::placeholder {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #0056c0;
                    font-size: 14px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                    box-shadow: 0px 0px 2px rgba(23, 32, 42, 0.8);
                }
            }

            textarea {
                color: #1f2328;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 15px;
                box-shadow: 0px 0px 2px rgba(23, 32, 42, 0.3);

                &::placeholder {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #0056c0;
                    font-size: 14px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                    box-shadow: 0px 0px 2px rgba(23, 32, 42, 0.8);
                }
            }

            select {
                color: #1f2328;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 15px;
                box-shadow: 0px 0px 1px rgba(23, 32, 42, 0.3);

                &::placeholder {
                    font-size: 14px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #0056c0;
                    font-size: 14px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                    /* box-shadow: 0px 0px 2px rgba(23, 32, 42, 0.8); */
                }
            }

            .input-correct {
                border-color: #2ecc71 !important;
                font-size: 14px;
                letter-spacing: .5px;
                color: #1f2328;
                outline: none;
                /* box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8); */
            }

            .input-error {
                border-color: #e74c3c !important;
                font-size: 14px;
                letter-spacing: .5px;
                color: #1f2328;
                outline: none;
                /* box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8); */
            }

            button {
                color: #ffffff;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 10px;
                margin: 0px;
            }

            .password-div {
                margin-bottom: 16px;
                padding: 0px;
                position: relative;

                .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 33%;
                    transform: translateY(15%);
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 14px;
                    color: #8c8f92;
                }
            }

            .choices__item--selectable {
                background-color: #e5f3fc;
                border-radius: 5px;
                padding: 1px 5px;
                margin: 5px;
                font-size: 0.9rem;
                border: 1px solid #ccc;
                color: #1f2328;
              
                .choices__button {
                    color: #ffffff important;
                    background-color: red;
                    padding: 2px 10px;
                    margin: 3px 0px 3px 3px;
                    font-size: 0.9rem;
                    border: 0;
                }
            }

            .choices__input {
                color: #1f2328;
                font-size: 14px;
                letter-spacing: 0.5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.3);
                padding: 2px 2px;
                margin: 3px 3px 3px 3px;
                outline: none;
                background-color: white; 
                min-width: 200px;
            }
        }   

        .modal-footer {
            padding: 5px 20px 15px 20px;
            gap: 8px;

            button {
                color: #ffffff;
                font-size: 14px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 40px;
                margin: 0px;
            }

            .danger {
                background-color: #ffffff;
                border: 1px solid #0d6Efd;
                color: #0d6Efd;
                font-size: 14.4px;
                font-weight: 500;
                letter-spacing: 0.5px;

                &:hover {
                    background-color: #e5f3fc;
                    border: 1px solid #0d6Efd;
                    color: #0d6Efd;
                }

                &:active {
                    border: 1px solid #0d6dfd2a;
                    transform: translateY(2px);
                }
            }

            .success {
                background-color: #0d6Efd;
                border: 1px solid #0d6Efd;
                color: #ffffff;
                font-size: 14.4px;
                font-weight: 400;
                letter-spacing: 0.5px;
                
                &:hover {
                    background-color: #0869fc;
                    border: 1px solid #0869fc;
                    color: #ffffff;
                    cursor: pointer;
                }

                &:active {
                    background-color: #0d6Efd;
                    border: 1px solid #0d6Efd;
                    transform: translateY(2px);
                }
            }
        }
    }

    .notyf__toast {
        max-width: none !important;
        width: auto !important;
        white-space: nowrap;
    }
</style>


