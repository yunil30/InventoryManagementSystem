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

<style>
    body {
        margin: 0;
        height: 100vh;
        display: grid;
        grid-template-rows: 3.5rem 1fr auto;
        grid-template-areas: 
            "header"
            "main"
            "footer";
        transition: all 1s ease;
        padding-right: 0 !important;
    }

    header {
        grid-area: header;
        background-color: #ffffff;
        box-shadow: 0px 1px 5px #00000047;
        padding: 0.5rem 2rem;
        position: sticky;
        display: flex;
        justify-content: space-between; 
        align-items: center;
        z-index: 10;

        .logo {
            padding: .1rem .1rem;
        }

        .header-logo-div {
            display: flex;
            justify-content: left;
            align-items: center;

            a {
                font-size: 20px;
                font-weight: 500;
                letter-spacing: .5px;
                text-decoration: none; 
                color: inherit; 

                i {
                    font-size: 24px; 
                    font-weight: 500;
                }

                span {
                    font-weight: 600;
                }
            }

            a:hover {
                text-decoration: none; 
                color: inherit;   
            }
        }

        ul {
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            list-style-type: none;
            overflow: hidden;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
            align-items: center; 
            gap: 25px;

            li {
                display: inline-block;
            }

            .menu-item a {
                border-radius: 0px;
                color: #1f2328;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: .5px;
                text-decoration: none;
                line-height: 36px;
                padding: .4rem .0rem .4rem .0rem;
                margin: 5px 0;
                text-align: center;
            }
        }
        
        .menu-item a:hover,
        .menu-item a:focus {
            border-radius: 0px;
            color: #357edd;
            border-bottom: 2px solid #357edd;
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
                height: 10%;
                
                h3 {
                    color: #1f2328;
                    font-size: 1.5rem;
                    font-weight: 600;
                    letter-spacing: .5px;
                    margin: 0;
                }

                button {
                    background-color: #0d6Efd;
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
                height: 100%;

                table {
                    th {
                        color: #1f2328;
                        font-size: 0.9rem;
                        font-weight: 600;
                        letter-spacing: .5px;
                    }

                    td {
                        color: #1f2328;
                        font-size: 0.9rem;
                        font-weight: 400;
                        letter-spacing: .5px;
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
                    box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.3);
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
                        box-shadow: 0px 1px 5px #00000035;
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

            select {
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
        }
    }
</style>


