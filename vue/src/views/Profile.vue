<template>
    <div class="profile">
        <div class="profileHeader">
            <div class="profileHeaderView">
                <div class="profileHeaderImage" v-if="friend.image">
                    <img :src="friend.image" />
                </div>
                <div class="profileHeaderImage" v-else>
                    <img src="@/assets/images/profile.jpeg" />
                </div>
            </div>
            <div class="profileHeaderData">
                <div>
                    <h1>{{ friend.username }} <span>{{ this.relation.name }}</span></h1>
                    <p>{{ friend.email }}</p>               
                    <p>BIO: {{ friend.id }}</p>
                </div>
                 <div class="profileHeaderScore">
                    <div
                        class="profileHeaderScorebar"
                        v-bind:style="{ height: '100%', width: reviewscore + '%' }"
                    >{{ reviewscore}} %</div>
                </div>
            </div>
            <div class="profileHeaderButtons">
                <div class="profileHeaderReport">
                    <button>Report</button>
                </div>
                <div class="profileHeaderRelation">
                    <button v-if="this.activeButton == ''" href="#" variant="primary">Friend</button>
                    <button
                        v-if="this.activeButton == 'pending_first_second'"
                        href="#"
                        variant="primary"
                    >Sent request</button>
                    <button
                        v-if="this.activeButton == 'pending_first_second'"
                        href="#"
                        variant="primary"
                    >Cancel request</button>
                    <button
                        v-if="this.activeButton == 'pending_second_first'"
                        href="#"
                        variant="primary"
                    >Accept request</button>
                    <button
                        v-if="this.activeButton == 'pending_second_first'"
                        href="#"
                        variant="primary"
                    >Deny request</button>
                    <button
                        v-if="this.activeButton == 'friends'"
                        href="#"
                        variant="primary"
                    >Unfriend</button>
                    <button v-if="this.activeButton == ''" href="#" variant="primary">Block</button>
                    <button
                        v-if="this.activeButton == 'block_first_second' || !this.activeButton == 'block_both'"
                        href="#"
                        variant="primary"
                    >Unblock</button>
                </div>
            </div>
        </div>
        <div class="profileGames">
            <div class="profileGamesNav"><i class="fa fa-arrow-left" aria-hidden="true"></i>
</div>
            <div class="profileGameCard">
                <div class="profileGameCardImage">
                    <img src="@/assets/images/profile.jpeg" />
                    <div class="profileGameCardName">Name of the game</div>
                </div>
                <div class="profileGameCardUsername">Username</div>
            </div>
             <div class="profileGameCard">
                <div class="profileGameCardImage">
                    <img src="@/assets/images/profile.jpeg" />
                    <div class="profileGameCardName">Name of the game</div>
                </div>
                <div class="profileGameCardUsername">Username</div>
            </div>
                   <div class="profileGameCard">
                <div class="profileGameCardImage">
                    <img src="@/assets/images/profile.jpeg" />
                    <div class="profileGameCardName">Name of the game</div>
                </div>
                <div class="profileGameCardUsername">Username</div>
            </div>
             <div class="profileGameCard">
                <div class="profileGameCardImage">
                    <img src="@/assets/images/profile.jpeg" />
                    <div class="profileGameCardName">Name of the game</div>
                </div>
                <div class="profileGameCardUsername">Username</div>
            </div>
            <div class="profileGamesNav"><i class="fa fa-arrow-right" aria-hidden="true"></i>
</div>
        </div>
        <div class="profileReviews">
            <div class="profileReviewCard">
                <div class="profileReviewCardImage">
                    <img src="@/assets/images/profile.jpeg" />
                </div>
                <div class="profileReviewCardUserInfo">
                    <p>username: <span>this is the comment.</span></p>
                    
                </div>
                <div class="profileReviewCardScore"><p>68</p></div>
            </div>

            <ReviewInput :id="friend.id" />
        </div>
    </div>
</template>

<script>
import { getFriend, getRelation } from "@/services/friend.api";

import ReviewInput from "@/components/ReviewInput";

export default {
    components: { ReviewInput },
    props: ["data"],
    data() {
        return {
            friend: [],
            relation: [],
            activeButton: "",
            reviewscore: 0
        };
    },
    async mounted() {
        try {
            const response = await getFriend(this.data);
            this.friend = response.data.user[0];
            console.log(response.data);

            console.log(this.friend);
            console.log(this.reviewscore);

            var score = 0;

            // gets the average score of all the reviews
            response.data.reviews.map(function(value) {
                score += parseFloat(value.score);
            });

            this.reviewscore = score / response.data.reviews.length;

            //console.log(this.friend.id);
        } catch (error) {
            console.log(error);
        }
        try {
            const response = await getRelation(this.data);
            console.log(response);
            this.relation = response.data[0];
            console.log(this.relation);

            this.activeButton = this.relation.name;

            console.log(this.activeButton);

            //console.log(this.friend.id);
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style></style>
