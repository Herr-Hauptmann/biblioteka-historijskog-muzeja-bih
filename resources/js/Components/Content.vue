<script setup>

</script>

<template>
    <header class="bg-white shadow" >
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mt-3">
            <slot name="header"/>
        </div>
    </header>  
    <slot></slot>
</template>