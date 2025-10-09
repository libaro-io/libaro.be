<script setup lang="ts">
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import TitleComponent from "@components/title-component.vue";
import {ref, onMounted, onUnmounted} from "vue";
import LargeImageComponent from "@components/large-image-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import BadgeComponent from "@components/badge-component.vue";
import {Link} from "@inertiajs/vue3";
import {isMobileOrTablet} from "@composables/UseDeviceAgent";

const props = withDefaults(defineProps<{
    listWithImage: ListWithImageInterface;
    isClickable?: boolean;
    coloredBackground?: boolean;
    enable3dEffect?: boolean;
}>(), {
    isClickable: true,
    enable3dEffect: false
});

const activeList = ref(0);
const indicatorRef = ref<HTMLElement>();
const listRef = ref<HTMLElement>();
const imageContainerRef = ref<HTMLElement>();
const tiltX = ref(0);
const tiltY = ref(0);

const setActive = (index: number): void => {
    if (!props.isClickable) {
        return;
    }
    activeList.value = index;
    updateIndicatorPosition(index);
}

const getImage = (): string => {
    return props.listWithImage.listItems[activeList.value].image;
}

const getAlt = (): string => {
    return getTrans(props.listWithImage.listItems[activeList.value].title);
}

const updateIndicatorPosition = (index: number): void => {
    if (!indicatorRef.value || !listRef.value) return;

    const listItems = listRef.value.querySelectorAll('li');
    const targetItem = listItems[index];

    if (targetItem) {
        const itemRect = targetItem.getBoundingClientRect();
        const listRect = listRef.value.getBoundingClientRect();
        const relativeTop = itemRect.top - listRect.top;
        const itemHeight = itemRect.height;

        indicatorRef.value.style.transform = `translateY(${relativeTop}px)`;
        indicatorRef.value.style.height = `${itemHeight}px`;
    }
}

const handleMouseEnter = (index: number): void => {
    updateIndicatorPosition(index);
}

const handleMouseLeave = (): void => {
    updateIndicatorPosition(activeList.value);
    // Reset tilt when leaving list item
    tiltX.value = 0;
    tiltY.value = 0;
}

const handleListItemMouseMove = (e: MouseEvent): void => {
    if(isMobileOrTablet()){
        return;
    }

    if (!imageContainerRef.value || !props.enable3dEffect){
        return;
    }

    const rect = imageContainerRef.value.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    // Calculate rotation based on mouse position (-15 to 15 degrees)
    const rotateY = ((x - centerX) / centerX) * 10;
    const rotateX = ((centerY - y) / centerY) * 10;

    tiltX.value = rotateX;
    tiltY.value = rotateY;
}

const handleResize = (): void => {
    updateIndicatorPosition(activeList.value);
}

onMounted(() => {
    setTimeout(() => {
        updateIndicatorPosition(activeList.value);
        window.addEventListener('resize', handleResize);
    }, 100);

});

onUnmounted(() => {
    window.removeEventListener('resize', handleResize);
});

const listClasses = (index: number): string[] => {
    return [
        'list-item',
        index === activeList.value ? 'active' : '',
        props.isClickable ? 'clickable' : '',
    ]
}

</script>
<template>
    <section class="component-list-with-image-component"
             :class="[{'colored-bg': props.coloredBackground}]">
        <div class="container">
            <header v-if="listWithImage.title || listWithImage.descriptions">
                <title-component v-if="listWithImage.title">
                    {{ getTrans(listWithImage.title) }}
                </title-component>
                <div class="texts" v-if="listWithImage.descriptions">
                    <p
                        :key="index"
                        v-for="(description, index) in listWithImage.descriptions"
                    >
                        {{ getTrans(description) }}
                    </p>
                </div>
            </header>
            <div class="list-image">
                <div class="list">
                    <div class="inner-list">
                        <div class="indicator">
                            <div class="inner-indicator" ref="indicatorRef"></div>
                        </div>
                        <ul
                            @mousemove="handleListItemMouseMove"
                            ref="listRef">
                            <li
                                :key="index"
                                @click="setActive(index)"
                                @mouseenter="handleMouseEnter(index)"
                                @mouseleave="handleMouseLeave"
                                :class="listClasses(index)"
                                :data-indicator-position="index"
                                v-for="(listItem, index) in listWithImage.listItems">
                                <h3>{{ getTrans(listItem.title) }}</h3>
                                <p>{{ getTrans(listItem.description) }}</p>
                                <div
                                    v-if="listItem.badges"
                                    class="badges">
                                    <badge-component
                                        :key="index"
                                        v-for="(badge, index) in listItem.badges"
                                    >
                                        {{ getTrans(badge) }}
                                    </badge-component>
                                </div>
                                <Link
                                    v-if="listItem.link"
                                    :href="listItem.link.url">
                                    {{ getTrans(listItem.link.title) }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="image-container"
                    ref="imageContainerRef"
                >
                    <div
                        class="inner-image-container"

                    >
                        <large-image-component
                            :style="{
                            transform: `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg) scale3d(1.05, 1.05, 1.05)`,
                            transition: tiltX === 0 && tiltY === 0 ? 'transform 0.5s ease-out' : 'none'
                        }"
                            :image="getImage()"
                            :alt="getAlt()"
                        ></large-image-component>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/list-with-image-component.css";
</style>
