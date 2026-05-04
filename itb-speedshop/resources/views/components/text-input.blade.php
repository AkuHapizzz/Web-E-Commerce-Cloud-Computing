@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 bg-gray-50 text-gray-900 focus:border-red-600 focus:ring-red-600 rounded-xl shadow-sm px-4 py-3 font-medium transition-colors']) }}>
