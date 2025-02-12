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
        font-family: Lato, Arial, sans-serif;
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

        ul {
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            list-style-type: none;
            overflow: hidden;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
            align-items: center; 

            li {
                display: inline-block;
            }

            .menu-item a {
                border-radius: 5px;
                color: #1f2328;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: 2px;
                text-decoration: none;
                line-height: 36px;
                padding: .4rem .65rem;
                margin: 5px 0;
                text-align: center;
            }
        }
        
        .menu-item a:hover,
        .menu-item a:focus {
            color: #173a68;
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
                    font-family: Lato, Arial, sans-serif;
                    color: #1f2328;
                    font-size: 1.5rem;
                    font-weight: 600;
                    letter-spacing: 2px;
                    margin: 0;
                }

                button {
                    font-family: Lato, Arial, sans-serif;
                    font-size: 0.9rem;
                    font-weight: 500;
                    letter-spacing: 2px;
                }
            }

            .content-body {
                height: 100%;

                table {
                    font-family: Lato, Arial, sans-serif;

                    th {
                        color: #1f2328;
                        font-size: 0.9rem;
                        font-weight: 600;
                        letter-spacing: 2px;
                    }

                    td {
                        color: #1f2328;
                        font-size: 0.9rem;
                        font-weight: 500;
                        letter-spacing: 2px;
                    }
                }

                .dt-layout-row {
                    font-family: Lato, Arial, sans-serif;
                    letter-spacing: 2px;

                    .dt-input {
                        font-family: Lato, Arial, sans-serif;
                        font-size: 0.9rem;
                        font-weight: 500;
                        letter-spacing: 2px;
                        padding: 8px 12px;
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
                font-family: Lato, Arial, sans-serif;
                color: #1f2328;
                font-size: 0.9rem;
                font-weight: 600;
                letter-spacing: 2px;
                margin: 0;
            }
        }
    }

    .modal {
        font-family: Lato, Arial, sans-serif;
        letter-spacing: 2px;
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
                font-family: Lato, Arial, sans-serif;
                font-size: 0.9rem;
                font-weight: 500;
                letter-spacing: 2px;
            }

            input {
                border: 1px solid rgb(215, 215, 215);
                border-radius: 1px;
                font-family: Lato, Arial, sans-serif;
                font-size: 0.9rem;
                font-weight: 400;
                letter-spacing: 2px;
            }
        }

        .modal-footer {
            padding: 5px 20px 15px 20px;

            button {
                font-family: Lato, Arial, sans-serif;
                font-weight: 400;
                letter-spacing: 2px;
                border-radius: 3px;
            }
        }
    }
</style>


