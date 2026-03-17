<script setup lang="ts">
import {computed, nextTick, onMounted, onUnmounted, ref, watch} from "vue";
import {getTrans} from "@composables/UseTranslationHelper";
import RoundedButton from "@components/buttons/rounded-button.vue";

const AUTOPLAY_INTERVAL = 3000;
const SWIPE_THRESHOLD = 50;

const props = withDefaults(defineProps<{
    images: string[];
    alt?: string;
}>(), {
    alt: 'Project image',
});

const getInitialIndex = (images: string[]): number => images.length > 1 ? 1 : 0;

const currentIndex = ref(getInitialIndex(props.images));
const isPaused = ref(false);
const isDragging = ref(false);
const isTransitioning = ref(false);
const shouldAnimate = ref(props.images.length > 1);
const touchStartX = ref(0);
const touchDeltaX = ref(0);
const trackRef = ref<HTMLElement | null>(null);

let autoplayTimer: ReturnType<typeof setInterval> | null = null;

const hasMultipleImages = computed((): boolean => props.images.length > 1);
const renderedImages = computed((): string[] => {
    if (!hasMultipleImages.value) {
        return props.images;
    }

    const firstImage = props.images[0];
    const lastImage = props.images[props.images.length - 1];

    return [lastImage, ...props.images, firstImage];
});
const trackOffset = ref('');
const trackTransition = ref('');

watch(
    [currentIndex, touchDeltaX, shouldAnimate, isDragging],
    () => {
        trackOffset.value = `translate3d(calc(-${currentIndex.value * 100}% + ${touchDeltaX.value}px), 0, 0)`;
        trackTransition.value = shouldAnimate.value && !isDragging.value
            ? 'transform 450ms cubic-bezier(0.22, 1, 0.36, 1)'
            : 'none';
    },
    { immediate: true }
);
const toggleLabel = computed((): string => {
    return isPaused.value
        ? getTrans('projects.resume_autoplay')
        : getTrans('projects.pause_autoplay');
});

const resetLoopPosition = async (targetIndex: number): Promise<void> => {
    shouldAnimate.value = false;

    await nextTick();

    if (trackRef.value) {
        trackRef.value.style.transition = 'none';
        trackRef.value.style.transform = `translate3d(-${targetIndex * 100}%, 0, 0)`;
        void trackRef.value.offsetHeight;
    }

    currentIndex.value = targetIndex;
    isTransitioning.value = false;

    await nextTick();

    if (trackRef.value) {
        trackRef.value.style.transition = '';
        trackRef.value.style.transform = '';
    }

    shouldAnimate.value = true;
};

watch(
    () => props.images.length,
    (length) => {
        currentIndex.value = getInitialIndex(props.images);
        shouldAnimate.value = length > 1;
        isTransitioning.value = false;
        isDragging.value = false;
        touchDeltaX.value = 0;
    }
);

const stopAutoplay = (): void => {
    if (autoplayTimer !== null) {
        clearInterval(autoplayTimer);
        autoplayTimer = null;
    }
};

const pauseAutoplay = (): void => {
    isPaused.value = true;
    stopAutoplay();
};

const startAutoplay = (): void => {
    stopAutoplay();

    if (!hasMultipleImages.value) {
        return;
    }

    autoplayTimer = setInterval(() => {
        advanceSlide('left');
    }, AUTOPLAY_INTERVAL);
};

const advanceSlide = (direction: 'left' | 'right'): void => {
    if (!hasMultipleImages.value || isTransitioning.value) {
        return;
    }

    isTransitioning.value = true;
    shouldAnimate.value = true;
    currentIndex.value += direction === 'left' ? 1 : -1;
};

const previousImage = (): void => {
    pauseAutoplay();
    advanceSlide('right');
};

const nextImage = (): void => {
    pauseAutoplay();
    advanceSlide('left');
};

const toggleAutoplay = (): void => {
    isPaused.value = !isPaused.value;

    if (isPaused.value) {
        stopAutoplay();
    } else {
        startAutoplay();
    }
};

const onTouchStart = (event: TouchEvent): void => {
    if (!hasMultipleImages.value) {
        return;
    }

    stopAutoplay();
    isDragging.value = true;
    touchStartX.value = event.changedTouches[0].clientX;
    touchDeltaX.value = 0;
};

const onTouchMove = (event: TouchEvent): void => {
    if (!isDragging.value) {
        return;
    }

    touchDeltaX.value = event.changedTouches[0].clientX - touchStartX.value;
};

const onTouchEnd = (): void => {
    if (!isDragging.value) {
        return;
    }

    const delta = touchDeltaX.value;

    isDragging.value = false;
    touchDeltaX.value = 0;

    if (Math.abs(delta) < SWIPE_THRESHOLD) {
        if (!isPaused.value) {
            startAutoplay();
        }

        return;
    }

    if (delta < 0) {
        nextImage();
    } else {
        previousImage();
    }
};

const onTrackTransitionEnd = (event: TransitionEvent): void => {
    if (event.propertyName !== 'transform' || !hasMultipleImages.value || !isTransitioning.value) {
        return;
    }

    if (currentIndex.value === 0) {
        resetLoopPosition(props.images.length);
        return;
    }

    if (currentIndex.value === props.images.length + 1) {
        resetLoopPosition(1);
        return;
    }

    isTransitioning.value = false;
};

onMounted(() => {
    startAutoplay();
});

onUnmounted(() => {
    stopAutoplay();
});

watch(hasMultipleImages, (value) => {
    if (value && !isPaused.value) {
        startAutoplay();
    } else {
        stopAutoplay();
    }
});
</script>
<template>
    <section class="component-image-carousel-component">
        <div class="preload-container">
            <img
                v-for="image in props.images"
                :key="image"
                :src="image"
                alt=""
            >
        </div>

        <div
            class="carousel-container"
            @touchstart.passive="onTouchStart"
            @touchmove.passive="onTouchMove"
            @touchend.passive="onTouchEnd"
        >
            <div class="image-container">
                <div class="image-viewport">
                    <div
                        ref="trackRef"
                        class="image-track"
                        :class="{ 'is-dragging': isDragging }"
                        :style="{ transform: trackOffset, transition: trackTransition }"
                        @transitionend="onTrackTransitionEnd"
                    >
                        <div
                            v-for="(image, index) in renderedImages"
                            :key="`${image}-${index}`"
                            class="image-slide"
                        >
                            <img
                                :src="image"
                                :alt="props.alt"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="hasMultipleImages" class="carousel-controls">
            <button
                class="autoplay-toggle"
                :aria-label="toggleLabel"
                @click="toggleAutoplay"
            >
                <i :class="isPaused ? 'fa-solid fa-play' : 'fa-solid fa-pause'"></i>
                <span>{{ toggleLabel }}</span>
            </button>

            <div class="nav-buttons">
                <rounded-button
                    aria-label="Previous image"
                    @click="previousImage"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </rounded-button>
                <rounded-button
                    aria-label="Next image"
                    @click="nextImage"
                >
                    <i class="fa-solid fa-chevron-right"></i>
                </rounded-button>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/image-carousel-component.css";
</style>
