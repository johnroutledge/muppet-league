<template>
    <div class="team-selection">
        <div class="row">
            <div class="col-md-6">
                 <!-- Filter Options -->
                <div class="filter-options">
                <h5>Filter Options</h5>
                <!-- Position Filter -->
                <label for="positionFilter">Position:</label>
                <select v-model="positionFilter" id="positionFilter">
                    <option value="">All</option>
                    <option value="1">Goalkeeper</option>
                    <option value="2">Defender</option>
                    <option value="3">Midfielder</option>
                    <option value="4">Forward</option>
                </select>
                <!-- Premier League Team Filter -->
                <label for="teamFilter">Premier League Team:</label>
                <select v-model="teamFilter" id="teamFilter">
                    <option value="">All</option>
                    <!-- Add options dynamically based on your data -->
                </select>
                </div>
                <!-- Available Players -->
                <div class="available-players">
                    <h5>Available Players</h5>
                    <ul>
                        <!-- <li v-for="player in availablePlayers" @click="addToTeam(player)">{{ player.name }} ({{ player.position_short_name }})</li> -->
                        <li v-for="player in filteredPlayers" @click="addToTeam(player)">
                            {{ player.name }} ({{ player.position_short_name }})
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Selected Team -->
                <div class="selected-team">
                    <h5>Selected Team</h5>
                    <ul>
                        <li v-for="player in selectedTeam" @click="removeFromTeam(player)">{{ player.name }} ({{ player.position_short_name }})</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
    export default {
        props: {
            availablePlayers: {
                type: Array,
                required: true,
            },
        },
        data() {
            return {
                // availablePlayers: [], // Populate this array with your available players
                selectedTeam: [],
                positionFilter: '', // Selected position filter
                teamFilter: '',     // Selected Premier League team filter
            };
        },
        computed: {
            filteredPlayers() {
            // Filter players based on position and Premier League team filters
                return this.availablePlayers.filter(player => {
                    const matchesPosition = !this.positionFilter || player.position == this.positionFilter;
                    const matchesTeam = !this.teamFilter || player.premier_league_team == this.teamFilter;

                    return matchesPosition && matchesTeam;
                });
            },
        },
        methods: {
            getPositionShortName(position) {
                switch (position) {
                    case 1: return 'GK';
                    case 2: return 'DEF';
                    case 3: return 'MID';
                    case 4: return 'FWD';
                    default: return ''; // Handle any other cases
                }
            },
            addToTeam(player) {
                // Add player to the selected team and remove from available players
                const index = this.availablePlayers.indexOf(player);
                if (index !== -1) {
                    this.availablePlayers.splice(index, 1);
                    this.selectedTeam.push(player);
                }
            },
            removeFromTeam(player) {
                // Remove player from the selected team and add back to available players
                const index = this.selectedTeam.indexOf(player);
                if (index !== -1) {
                    this.selectedTeam.splice(index, 1);

                    // Find the correct position to insert the player based on their position
                    const insertIndex = this.availablePlayers.findIndex(
                        availablePlayer => availablePlayer.position > player.position
                    );

                    // If no specific insert position is found, add to the end of the array
                    if (insertIndex === -1) {
                        this.availablePlayers.push(player);
                    } else {
                        this.availablePlayers.splice(insertIndex, 0, player);
                    }
                }
            },
        },
    };
</script>

<style scoped>
/* Add your CSS styles here */
</style>
  