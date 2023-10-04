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
                    <option v-for="team in premierLeagueTeams" :value="team.id">{{ team.name }}</option>
                </select>
                </div>
                <!-- Available Players -->
                <div class="available-players">
                    <h5>Available Players</h5>
                    <ul>
                        <!-- <li v-for="player in availablePlayers" @click="addToTeam(player)">{{ player.first_name }} {{ player.surname }} ({{ player.position_short_name }})</li> -->
                        <li v-for="player in filteredPlayers" @click="addToTeam(player)" 
                            :class="{ 'disabled': goalkeeperSelected && player.position === 1 || isDefenderLimitReached(player) 
                                || isMidfielderLimitReached(player) || isForwardLimitReached(player) }">
                            {{ player.first_name }} {{ player.surname }} ({{ player.position_short_name }}) £{{ player.price_pence / 10000000 }}m
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Selected Team -->
                <div class="selected-team">
                    <h5>Selected Team</h5>
                    <p>Team Value: £{{ teamValue / 10000000 }}m</p>
                    <ul>
                        <li v-for="player in selectedTeam" @click="removeFromTeam(player)">{{ player.first_name }} {{ player.surname }} ({{ player.position_short_name }})</li>
                    </ul>
                </div>
                <button @click="saveTeam" :disabled="isSaveButtonDisabled">Save</button>
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
            premierLeagueTeams: {
                type: Array,
                required: true,
            },
        },
        data() {
            return {
                selectedTeam: [],
                positionFilter: '',
                teamFilter: '',
                goalkeeperSelected: false,
                defendersSelected: 0,
                midfieldersSelected: 0,
                forwardsSelected: 0,
                teamValue: 0,
                isSaveButtonDisabled: true,
            };
        },
        computed: {
            filteredPlayers() {
                // Filter players based on position and Premier League team filters
                return this.availablePlayers.filter(player => {
                    const matchesPosition = !this.positionFilter || player.position == this.positionFilter;
                    const matchesTeam = !this.teamFilter || player.premier_league_team_id == this.teamFilter;

                    return matchesPosition && matchesTeam;
                });
            },
            calculatedTeamValue() {
                return this.selectedTeam.reduce((totalValue, player) => totalValue + player.price_pence, 0);
            },
            shouldDisableSaveButton() {
                const numberOfPlayers = this.selectedTeam.length;
                const teamValueInPounds = this.teamValue / 10000000; // Convert to pounds (assuming player.price_pence is in pence)
                return numberOfPlayers !== 11 || teamValueInPounds < 50;
            },
        },
        watch: {
            calculatedTeamValue(newValue) {
                this.teamValue = newValue;
            },
            shouldDisableSaveButton(newValue) {
                this.isSaveButtonDisabled = newValue;
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
                if (this.goalkeeperSelected && player.position === 1) {
                    return; // Prevent selecting another goalkeeper
                }

                if (player.position === 2 && this.defendersSelected >= 4) {
                    return; // Prevent selecting more than 4 defenders
                }

                if (player.position === 3 && this.midfieldersSelecteddersSelected >= 4) {
                    return; // Prevent selecting more than 4 midfielders
                }

                if (player.position === 4 && this.forwardsSelected >= 2) {
                    return; // Prevent selecting more than 2 forwards
                }

                // Add player to the selected team and remove from available players
                const index = this.availablePlayers.indexOf(player);
                if (index !== -1) {
                    this.availablePlayers.splice(index, 1);
                    this.selectedTeam.push(player);

                    if (player.position === 1) {
                        this.goalkeeperSelected = true;
                    }

                    if (player.position === 2) {
                        this.defendersSelected += 1;
                    }

                    if (player.position === 3) {
                        this.midfieldersSelected += 1;
                    }

                    if (player.position === 4) {
                        this.forwardsSelected += 1;
                    }
                }
            },
            removeFromTeam(player) {
                // Remove player from the selected team and add back to available players
                const index = this.selectedTeam.indexOf(player);
                if (index !== -1) {
                    this.selectedTeam.splice(index, 1);

                    if (player.position === 1) {
                        this.goalkeeperSelected = false;
                    }

                    if (player.position === 2) {
                        this.defendersSelected -= 1;
                    }

                    if (player.position === 3) {
                        this.midfieldersSelected -= 1;
                    }

                    if (player.position === 4) {
                        this.forwardsSelected -= 1;
                    }

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
            isDefenderLimitReached(player) {
                return player.position === 2 && this.defendersSelected >= 4;
            },
            isMidfielderLimitReached(player) {
                return player.position === 3 && this.midfieldersSelected >= 4;
            },
            isForwardLimitReached(player) {
                return player.position === 4 && this.forwardsSelected >= 2;
            },
        },
    };
</script>

<style scoped>
    .disabled {
        pointer-events: none;
        color: gray;
    }
</style>
  