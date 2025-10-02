<script setup lang="ts">
import {ListWithImageInterface} from "@interfaces/ListWithImageInterface";
import TitleComponent from "@components/title-component.vue";
import {ref, onMounted, nextTick, onUnmounted, computed} from "vue";
import LargeImageComponent from "@components/large-image-component.vue";
import {getTrans} from "@composables/UseTranslationHelper";
import BadgeComponent from "@components/badge-component.vue";

const props = withDefaults(defineProps<{
    listWithImage: ListWithImageInterface;
    isClickable?: boolean;
}>(),{
    isClickable: true
});

const activeList = ref(0);
const indicatorRef = ref<HTMLElement>();
const listRef = ref<HTMLElement>();

const setActive = (index: number) => {
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

const updateIndicatorPosition = (index: number) => {
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

const handleMouseEnter = (index: number) => {
    updateIndicatorPosition(index);
}

const handleMouseLeave = () => {
    updateIndicatorPosition(activeList.value);
}

const handleResize = () => {
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
    <section class="component-list-with-image-component">
        <header v-if="listWithImage.title || listWithImage.descriptions">
            <title-component v-if="listWithImage.title">
                {{ getTrans(listWithImage.title) }}
            </title-component>
            <div class="texts" v-if="listWithImage.descriptions">
                <p v-for="description in listWithImage.descriptions">
                    {{ getTrans(description) }}
                </p>
            </div>
        </header>
        <div class="list-image">
            <div class="list">
                <div class="inner-list">
                    <div class="indicator">
                        <div class="inner-indicator"  ref="indicatorRef"></div>
                    </div>
                    <ul ref="listRef">
                        <li
                            key="index"
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
                                <badge-component v-for="badge in listItem.badges">
                                    {{ getTrans(badge) }}
                                </badge-component>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="image-container">
                <div class="inner-image-container">
                    <large-image-component
                        :image="getImage()"
                        :alt="getAlt()"
                    ></large-image-component>
                </div>
            </div>
        </div>
    </section>
</template>
<style scoped>
@import "@css/components/list-with-image-component.css";
</style>
