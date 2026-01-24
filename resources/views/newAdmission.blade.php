<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('New Admission Form') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
          <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-stone-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
              <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
              <div>
                <p class="font-bold">Important</p>
                <p class="text-sm">Once the account is created, data cannot be modified or changed. Please ensure accurate information is entered for all fields in this form.</p>
              </div>
            </div>
          </div>
          <form>
            <div class="mt-6 mb-12">
              <h2 class="text-base/7 font-semibold text-gray-900">
                Personal Information
              </h2>
              <p class="text-sm/6 text-rose-500 font-semibold border-b border-gray-900/10 pb-5">
                **This information will not be shared with the public and will be used only for future document preparation and certification purposes.**
              </p>
              <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-2 sm:col-start-1">
                  <label for="full-name" class="block text-sm/6 font-medium text-gray-900">
                    Full Name (English)
                  </label>
                  <div class="mt-2">
                    <input id="full-name" type="text" name="full-name" autocomplete="full-name-english"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Full Name"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="full-bangle-name" class="block text-sm/6 font-medium text-gray-900">
                    সম্পূর্ণ নাম (বাংলায়)
                  </label>
                  <div class="mt-2">
                    <input id="full-bangle-name" type="text" name="full-bangle-name" autocomplete="full-name-bangla"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="সম্পূর্ণ নাম লিখুন"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="gender" class="block text-sm/6 font-medium text-gray-900">
                    Gender
                  </label>
                  <div class="mt-2 grid grid-cols-1">
                    <select id="gender" name="gender" autocomplete="gender-type" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      <option selected>
                        Male
                      </option>
                      <option>
                        Female
                      </option>
                      <option>
                        Others
                      </option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                <div class="col-span-full">
                  <label for="current-address" class="block text-sm/6 font-medium text-gray-900">
                    Current Address (বর্তমান ঠিকানা)
                  </label>
                  <div class="mt-2">
                    <input id="current-address" type="text" name="current-address" autocomplete="current-address"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Current Address"
                    />
                  </div>
                </div>
                <div class="col-span-full">
                  <label for="permanent_address" class="block text-sm/6 font-medium text-gray-900">
                    Permanent Address (স্থায়ী ঠিকানা)
                  </label>
                  <div class="mt-2">
                    <input id="permanent_address" type="text" name="permanent_address" autocomplete="permanent-address"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Permanent Address"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="phone" class="block text-sm/6 font-medium text-gray-900">
                    Contact Number (যোগাযোগের নম্বর)
                  </label>
                  <div class="mt-2">
                    <input id="phone" type="tel" name="phone" autocomplete="phone" placeholder="+880 1777-9999-0000" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="email" class="block text-sm/6 font-medium text-gray-900">
                    Email Address If have (ইমেইল ঠিকানা)
                  </label>
                  <div class="mt-2">
                    <input id="email" type="email" name="email" placeholder="example@gmail.com" autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="date-of-birth" class="block text-sm/6 font-medium text-gray-900">
                    Date of birth ( জন্ম তারিখ )
                  </label>
                  <div class="mt-2">
                    <input id="date-of-birth" type="date" name="date-of-birth" autocomplete="date-of-birth"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2 sm:col-start-1">
                  <label for="district" class="block text-sm/6 font-medium text-gray-900">
                    District (জেলা)
                  </label>
                  <div class="mt-2">
                    <input id="district" type="text" name="district" autocomplete="district"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Dhaka"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="police_station" class="block text-sm/6 font-medium text-gray-900">
                    Police station (থানা)
                  </label>
                  <div class="mt-2">
                    <input id="police_station" type="text" name="police_station" autocomplete="police-station"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Gulshan"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="postal-code" class="block text-sm/6 font-medium text-gray-900">
                    ZIP / Postal code
                  </label>
                  <div class="mt-2">
                    <input id="postal-code" type="text" name="postal-code" autocomplete="postal-code"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="1212"
                    />
                  </div>
                </div>              
              </div>
              <div class="mt-12">
               <div class="border-b border-gray-900/10 pb-5">
                    <h2 class="text-base/7 font-semibold text-gray-900">
                      Passport Information
                    </h2>
                    <p class="mt-1 text-sm/6 text-rose-500 font-semibold">
                      ** The following information is required for the issuance of the Takamol Certificate. 
                      <br>Applicants must submit valid documents, a clear photograph, and a scanned copy of their passport.**
                    </p>
               </div>
               <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 pb-5">
                <div class="sm:col-span-3">
                    <label for="passport-number" class="block text-sm/6 font-medium text-gray-900">
                      Passport Number (পাসপোর্ট নম্বর) <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-2">
                      <input id="passport-number" type="number" name="passport-number" autocomplete="passport-number"
                      class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter your passport number" required/>
                    </div>
                  </div>
                  <div class="sm:col-span-3">
                    <label for="passport-expiry-date" class="block text-sm/6 font-medium text-gray-900">
                      Date of Passport Expiry (মেয়াদ) <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-2">
                      <input id="passport-expiry-date" type="date" name="passport-expiry-date" autocomplete="expiry-date"
                      class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Passport Expiry Date"
                      />
                    </div>
                  </div>
               </div>
                <div class="col-span-full pb-5">
                  <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Passport Scanned File</label>
                  <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                    <div class="text-center">
                      <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                      </svg>
                      <div class="mt-4 flex text-sm/6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                          <span>Upload a Clear Scanned File</span>
                          <input id="file-upload" type="file" name="file-upload" class="sr-only" />
                        </label>
                        <p class="pl-1">or drag and drop</p>
                      </div>
                      <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                    </div>
                  </div>
                </div>

                <div class="col-span-full pb-5">
                  <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Passport Size Photo</label>
                  <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-5">
                    <div class="text-center">
                      <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                      </svg>
                      <div class="mt-4 flex text-sm/6 text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                          <span>Upload your Best Photo</span>
                          <input id="file-upload" type="file" name="file-upload" class="sr-only" />
                        </label>
                        <p class="pl-1">or drag and drop</p>
                      </div>
                      <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 2MB</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="border-b border-gray-900/10 mt-6 pb-5">
               <div class="border-b border-gray-900/10 pb-3">
                    <h2 class="text-base/7 font-semibold text-gray-900">
                      Admission Required Information
                    </h2>
                    <p class="mt-1 text-sm/6 text-rose-500 font-semibold">
                      **This information is important for admission. Please choose carefully.**
                    </p>
               </div>
               <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 pb-5">
                <div class="sm:col-span-3">
                  <label for="training-center" class="block text-sm/6 font-medium text-gray-900">
                    Select Training Center
                  </label>
                  <div class="mt-2 grid grid-cols-1">
                    <select id="training-center" name="training-center" autocomplete="training-center" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      <option disabled selected>
                        ট্রেনিং সেন্টার নির্বাচন করুন 
                      </option>
                      <option>
                        Musa Training and Testing Center 
                      </option>
                      <option>
                        Siddiqua Training and Testing Center
                      </option>                      
                      <option>
                        Lamia Training and Testing Center
                      </option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                <div class="sm:col-span-3">
                  <label for="trade" class="block text-sm/6 font-medium text-gray-900">
                    Select Trade
                  </label>
                  <div class="mt-2 grid grid-cols-1">
                    <select id="trade" name="trade" autocomplete="trade-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      <option disabled selected>
                        ট্রেড নির্বাচন করুন 
                      </option>
                      <option>
                        সিভিল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট  
                      </option> 
                      <option>
                        মেকানিক্যাল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট 
                      </option>
                      <option>
                        ভাষা শিক্ষা ডিপার্টমেন্ট
                      </option>                      
                      <option>
                        ইলেক্ট্রিক্যাল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট 
                      </option>
                      <option>
                        সিকিউরিটি ডিপার্টমেন্ট
                      </option>
                      <option>
                        কম্পিউটার ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                      <option>
                        ফুড এন্ড বেভারেজ হসপিটালিটি ডিপার্টমেন্ট
                      </option>
                      <option>
                        ওয়েল্ডিং ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                      <option>
                        অটোমোবাইল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                <div class="sm:col-span-3">
                  <label for="course" class="block text-sm/6 font-medium text-gray-900">
                    Select Course
                  </label>
                  <div class="mt-2 grid grid-cols-1">
                    <select id="course" name="course" autocomplete="course-name" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      <option disabled selected>
                        কোর্স নির্বাচন করুন 
                      </option>
                      <option>
                        সিভিল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট  
                      </option> 
                      <option>
                        মেকানিক্যাল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট 
                      </option>
                      <option>
                        ভাষা শিক্ষা ডিপার্টমেন্ট
                      </option>                      
                      <option>
                        ইলেক্ট্রিক্যাল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট 
                      </option>
                      <option>
                        সিকিউরিটি ডিপার্টমেন্ট
                      </option>
                      <option>
                        কম্পিউটার ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                      <option>
                        ফুড এন্ড বেভারেজ হসপিটালিটি ডিপার্টমেন্ট
                      </option>
                      <option>
                        ওয়েল্ডিং ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                      <option>
                        অটোমোবাইল ইঞ্জিনিয়ারিং ডিপার্টমেন্ট
                      </option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                <div class="sm:col-span-3">
                  <label for="reference" class="block text-sm/6 font-medium text-gray-900">
                    Reference (রেফারেন্স)
                  </label>
                  <div class="mt-2">
                    <input id="reference" type="text" name="reference" autocomplete="reference"
                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="যার মাধ্যমে আসছেন"
                    />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="course-duration" class="block text-sm/6 font-medium text-gray-900">
                    Course Duration (কোর্সের মেয়াদ) 
                  </label>
                  <div class="mt-2 grid grid-cols-1">
                    <select id="course-duration" name="course-duration" autocomplete="course-duration" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option disabled selected>
                          মেয়াদ নির্বাচন করুন
                        </option>
                        <option>
                          ২ সপ্তাহ 
                        </option> 
                        <option>
                          ৪ সপ্তাহ
                        </option>
                    </select>
                    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                    class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                      clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="cost-fee" class="block text-sm/6 font-medium text-gray-900">
                    Total Cost Including Course Fee, Living, and Food 
                  </label>
                  <div class="mt-2">
                      <input id="cost-fee" type="number" name="cost-fee" disabled autocomplete="cost-fee"
                      class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Cost in BDT"
                      />
                  </div>
                </div>
                <div class="sm:col-span-2">
                  <label for="money-recived" class="block text-sm/6 font-medium text-gray-900">
                    Who received this amount? 
                  </label>
                  <div class="mt-2">
                      <input id="money-recived" type="text" name="money-recived" autocomplete="money-recived"
                      class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="আপনার নাম লিখুন..."
                      />
                  </div>
                </div>
               </div>
              </div>
            </div>

            <div class="flex items-start mb-5">
              <label for="remember-alternative" class="flex items-center h-5">
                <input id="remember-alternative" type="checkbox" value="" class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft" required />
                <p class="ms-2 text-sm font-medium text-heading select-none">I agree with the <a href="#" class="text-fg-brand hover:underline">terms and conditions</a>.</p>
              </label>
            </div>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>