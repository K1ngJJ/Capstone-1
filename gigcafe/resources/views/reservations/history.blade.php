@extends('layouts.app')

@section('navTheme')
{{ 'dark' }}@endsection

@section('logoFileName')
{{ URL::asset('/images/Black Logo.png') }}@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    <style>
        .menu-title {
            text-align: center;
            font-style: italic;
            color: black;
            font-size: 30px;
        }

        .bg-custom-color {
            background-color: #CE3232;
        }

        .bg-custom-color:hover {
            background-color: #dfe1e2;
            transition-duration: 0.8s;
        }

        .text-custom {
            color: white;
        }

        .text-custom:hover {
            color: black;
            transition-duration: 0.8s;
        }

        .table-container {
            overflow-x: auto; 
            max-width: 100%; 
        }

        .modal-footer .btn-primary {
            background-color: #ce3232; 
            border-color: #ce3232;
        }

        .modal-footer .btn-danger {
            background-color: black;
            border-color: black;
        }

        .modal-footer .btn-primary:hover {
            background-color: black;
            border-color: black;
        }

        .stars {
            display: inline-block;
            font-size: 40px; 
            cursor: pointer;
        }

        .star {
            color: #ddd; 
        }

        .star.selected {
            color: gold; 
        }
    </style>
    </head>

    @section('content')
<section class="banner">
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="container w-full px-5 py-6 mx-auto">
            <h6 class="d-flex justify-content-center menu-title">CATERING RESERVATION HISTORY</h2>
            <hr class="my-4">
            <div class="grid lg:grid-cols-1 gap-y-6">
                <div class="table-container">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-2 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            <strong>Reso_ID</strong>
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Date
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Service
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Package
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Guests
                                        </th>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Supply
                                        </th>
                                        <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Status
                                         </th>
                                         <th scope="col" class="relative py-3 px-6 flex justify-end items-center">
                                            <span class="sr-only">Edit</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-2 text-sm font-medium text-gray-900  dark:text-white">
                                        <strong>#{{ $reservation->id }}</strong>
                                        </td>
                                        <td class="py-4 px-2 text-sm font-medium text-gray-900  dark:text-white">
                                            {{ $reservation->first_name }} {{ $reservation->last_name }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->email }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->res_date }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->service ? $reservation->service->name : 'No package associated' }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->package ? $reservation->package->name : 'No package associated' }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->guest_number }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->inventory_supplies }}
                                        </td>
                                        <td class="py-4 px-2 text-sm text-gray-500  dark:text-gray-400">
                                            {{ $reservation->status }}
                                        </td>
                                        <td class="py-4 px-2 text-sm font-medium text-right ">
                                            <div class="flex space-x-2">
                                                @if($reservation->status == 'Fulfilled')
                                                <button class="py-2 px-4 bg-green-500 hover:bg-green-700 rounded-lg text-white rate-btn" data-reservation-id="{{ $reservation->id }}">Rate</button>
                                                @else
                                                    <button class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white">Cancel</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="RateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="editModalLabel">Rate Reservation</h2>
                                    </div>
                                    <div class="modal-body">
                                    <label>Service</label><br>
                                    <div class="stars" id="stars">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="rating" id="rating" value="0"> <!-- This will store the selected rating -->
                                        <!-- Add this HTML code inside your modal body -->
                                        <br><label>Food </label><br>
                                    <div class="stars" id="qualityStars">
                                        <span class="star" data-value="1">&#9733;</span>
                                        <span class="star" data-value="2">&#9733;</span>
                                        <span class="star" data-value="3">&#9733;</span>
                                        <span class="star" data-value="4">&#9733;</span>
                                        <span class="star" data-value="5">&#9733;</span>
                                    </div>
                                    <input type="hidden" name="qualityRating" id="qualityRating" value="0"> <!-- This will store the selected rating -->

                                    <hr>
                                    <div>
                                         <br>
                                        <label>Overall Rating:</label>
                                        <span id="averageRating"></span>
                                    </div>
                                            <div id="overallRatingStars" class="stars">
                                                <!-- Stars for overall rating will be displayed here -->
                                            </div>

                                    <br><label>Comments:</label>
                                    <textarea id="comment" class="form-control" rows="3"></textarea>
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" id="submitRating">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $('.rate-btn').click(function () {
            $('#rateModal').modal('show');
        });

        // Function to handle click on stars for service rating
        $('#stars .star').click(function () {
            var rating = $(this).attr('data-value'); // Get the rating value
            $('#rating').val(rating); // Set the rating value in the hidden input field

            // Update visual appearance of stars
            $('#stars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');

            // Calculate average and update overall rating stars
            updateOverallRating();
        });

        // Function to handle click on stars for quality rating
        $('#qualityStars .star').click(function () {
            var qualityRating = $(this).attr('data-value'); // Get the rating value
            $('#qualityRating').val(qualityRating); // Set the rating value in the hidden input field

            // Update visual appearance of stars
            $('#qualityStars .star').removeClass('selected');
            $(this).prevAll().addBack().addClass('selected');

            // Calculate average and update overall rating stars
            updateOverallRating();
        });

        // Function to update overall rating stars based on average
        function updateOverallRating() {
            var serviceRating = parseInt($('#rating').val());
            var qualityRating = parseInt($('#qualityRating').val());
            var averageRating = (serviceRating + qualityRating) / 2;

            // Update visual appearance of overall rating stars
            $('#overallRatingStars').empty(); // Clear existing stars

            // Fill up stars based on average rating
            for (var i = 1; i <= 5; i++) {
                var starClass = i <= averageRating ? 'selected' : ''; // Add 'selected' class for filled stars
                $('#overallRatingStars').append('<span class="star ' + starClass + '">&#9733;</span>');
            }

            // Update average rating value
            $('#averageRating').text(averageRating.toFixed(1)); // Display average rating with one decimal place
        }

        // Function to handle modal submission for service rating
        $('#submitRating').click(function () {
            var reservationId = $('#rateModal').data('reservation-id');
            var rating = $('#rating').val();

            // Perform AJAX request to submit the service rating
            // Example:
            $.ajax({
                url: '/submit-service-rating',
                method: 'POST',
                data: {
                    reservationId: reservationId,
                    rating: rating
                },
                success: function (response) {
                    // Handle success response
                    $('#rateModal').modal('hide');
                    // You can update UI or show a confirmation message here
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        // Function to handle modal submission for quality rating
        $('#submitQualityRating').click(function () {
            var reservationId = $('#rateModal').data('reservation-id');
            var qualityRating = $('#qualityRating').val();

            // Perform AJAX request to submit the quality rating
            // Example:
            $.ajax({
                url: '/submit-quality-rating',
                method: 'POST',
                data: {
                    reservationId: reservationId,
                    qualityRating: qualityRating
                },
                success: function (response) {
                    // Handle success response
                    $('#rateModal').modal('hide');
                    // You can update UI or show a confirmation message here
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>


</section>
</html>
@endsection
