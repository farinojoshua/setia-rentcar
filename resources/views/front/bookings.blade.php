<x-front-layout>

  <!-- Popular Cars -->
    <section class="bg-darkGrey" id="popularCars">
    <div class="container relative py-[100px]">
      <header class="mb-[30px]">
        <h2 class="font-bold text-dark text-[26px] mb-1">
          Pesanan Saya
        </h2>
      </header>

        @if ($bookings->count() == 0)
         <p class="text-xl">Kamu belum memesan apa-apa</p>
        @else
         <!-- Cars -->
       <div class="grid grid-cols-4 gap-8">
        @foreach ($bookings as $booking)
          <!-- Card -->
          <div class="card-popular">
            <div class="">
              <h5 class="text-xl text-dark font-bold mb-[2px]">
                {{ $booking->car->name }}
              </h5>
              {{-- add photo item --}}
              <p class="text-sm font-normal text-secondary">
                Tanggal Awal : {{ $booking->start_date }}
              </p>
              <p class="text-sm font-normal text-secondary">
                Tanggal Kembali : {{ $booking->end_date }}
              </p>
               <p class="text-sm font-normal text-secondary">
                  Total Biaya : {{ $booking->payment_amount }}
                </p>
              <p class="text-sm font-normal text-secondary">
                Status Pembayaran : {{ $booking->payment_status }}
              </p>
              <p class="text-sm font-normal text-secondary">
                Status Pemesanan{{ $booking->status }}
              </p>
               {{-- if payment_url != NULL return button to pay  --}}
                @if ($booking->payment_url != NULL)
                    <a href="{{ $booking->payment_url }}" class="btn btn-primary">Bayar</a>
                @endif

            </div>
          </div>
        @endforeach
        </div>
     @endif
    </div>
     </section>


  <footer class="py-10 md:pt-[100px] md:pb-[70px] container">
    <p class="text-base text-center text-secondary">
     2023 Copyright SetiaAbadi | Created by Farino Joshua
    </p>
  </footer>


</x-front-layout>
