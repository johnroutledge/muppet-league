<template>
    <div class="team-selection">
        <div class="row">
            <div v-if="successMessage" class="col-md-12 alert alert-success">{{ successMessage }}</div>
            <div class="col-md-6 fixed-column">
                <!-- Selected Team -->
                <div class="selected-team">
                    <h5>Selected Team</h5>
                    <ul>
                        <li>Click on a player to add/remove from your team</li>
                        <li>Minimum spend: £50m</li>
                        <li>No more than 2 players from the same team</li>
                        <li>Formation is 4-4-2</li>
                    </ul>
                    <div class="team-name my-2">
                        <label for="teamName" class="me-2">Team Name:</label>
                        <input v-model="teamName" type="text" id="teamName" placeholder="Enter your team name">
                    </div>
                    <div>
                        <p>Team Value: £{{ teamValue / 10000000 }}m (target: 50m)</p>
                    </div>
                    <ul>
                        <li v-for="player in selectedTeam" @click="removeFromTeam(player)"> {{ player.first_name }} {{
                            player.surname }} {{ player.team_short_name }} ({{ player.position_short_name }})</li>
                    </ul>
                </div>
                <button class="btn btn-success" @click="saveTeam"
                    v-if="!isSaveButtonDisabled && !isTeamNameEmpty && !saving">Save</button>
            </div>
            <div class="col-md-6">
                <h5>Available Players</h5>
                <div class="filter-options">
                    <!-- Position Filter -->
                    <div class="my-2">
                        <label for="positionFilter" class="me-2">Position:</label>
                        <select v-model="positionFilter" id="positionFilter">
                            <option value="">All</option>
                            <option value="1">Goalkeeper</option>
                            <option value="2">Defender</option>
                            <option value="3">Midfielder</option>
                            <option value="4">Forward</option>
                        </select>
                    </div>
                    <!-- Premier League Team Filter -->
                    <div class="my-2">
                        <label for="teamFilter" class="me-2">Premier League Team:</label>
                        <select v-model="teamFilter" id="teamFilter">
                            <option value="">All</option>
                            <option v-for="team in premierLeagueTeams" :value="team.id">{{ team.name }}</option>
                        </select>
                    </div>
                </div>
                <!-- Available Players -->
                <div class="available-players">
                    <ul>
                        <li v-for="player in filteredPlayers" @click="addToTeam(player)" :class="{
                            'disabled':
                                goalkeeperSelected && player.position === 1 ||
                                isDefenderLimitReached(player) ||
                                isMidfielderLimitReached(player) ||
                                isForwardLimitReached(player) ||
                                isMaxPlayersReached(player.premier_league_team_id)
                        }">
                            {{ player.first_name }} {{ player.surname }} {{ player.team_short_name }} ({{
                                player.position_short_name }}) £{{ player.price_pence / 10000000 }}m
                        </li>
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
        premierLeagueTeams: {
            type: Array,
            required: true,
        },
        selectedPlayers: {
            type: Array,
            default: () => [], // Initialize it as an empty array
        },
        teamName: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            selectedTeam: this.selectedPlayers,
            positionFilter: '',
            teamFilter: '',
            goalkeeperSelected: false,
            defendersSelected: 0,
            midfieldersSelected: 0,
            forwardsSelected: 0,
            teamValue: 0,
            isSaveButtonDisabled: true,
            teamPlayerCounts: {},
            saving: false,
            successMessage: '',
        };
    },
    created() {
        console.log(this.teamName);
        this.calculateInitialPlayerCounts();
        this.calculateInitialTeamValue();
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
            const teamValueInPounds = this.teamValue / 10000000;
            return numberOfPlayers !== 11 || teamValueInPounds < 50;
        },
        isTeamNameEmpty() {
            return !this.teamName.trim();
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
        calculateInitialPlayerCounts() {
            // Initialize counts
            this.goalkeeperSelected = false;
            this.defendersSelected = 0;
            this.midfieldersSelected = 0;
            this.forwardsSelected = 0;

            // Loop through the selectedPlayers and update counts
            this.selectedPlayers.forEach(player => {
                if (player.position === 1) {
                    this.goalkeeperSelected = true;
                } else if (player.position === 2) {
                    this.defendersSelected++;
                } else if (player.position === 3) {
                    this.midfieldersSelected++;
                } else if (player.position === 4) {
                    this.forwardsSelected++;
                }
            });
        },
        calculateInitialTeamValue() {
            // Initialize teamValue to 0
            this.teamValue = 0;

            // Calculate the team value based on selectedPlayers' prices
            this.selectedPlayers.forEach(player => {
                this.teamValue += player.price_pence;
            });
        },
        getPositionShortName(position) {
            switch (position) {
                case 1: return 'GK';
                case 2: return 'DEF';
                case 3: return 'MID';
                case 4: return 'FWD';
                default: return '';
            }
        },
        addToTeam(player) {

            if (this.goalkeeperSelected && player.position === 1) {
                return;
            }

            if (player.position === 2 && this.defendersSelected >= 4) {
                return;
            }

            if (player.position === 3 && this.midfieldersSelecteddersSelected >= 4) {
                return;
            }

            if (player.position === 4 && this.forwardsSelected >= 2) {
                return;
            }

            const teamId = player.team_id;

            // Add player to the selected team and remove from available players
            if (!this.isMaxPlayersReached(teamId)) {
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

                    // if (!this.teamPlayerCounts[teamId]) {
                    //     this.teamPlayerCounts[teamId] = 1;
                    // } else {
                    //     this.teamPlayerCounts[teamId]++;
                    // }
                    if (!this.teamPlayerCounts[player.premier_league_team_id]) {
                        this.teamPlayerCounts[player.premier_league_team_id] = 1;
                    } else {
                        this.teamPlayerCounts[player.premier_league_team_id]++;
                    }
                }
            }
            this.sortSelectedTeamByPosition();
            console.log(this.selectedTeam);
        },
        removeFromTeam(player) {
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

                // const teamId = player.team_id;
                // const index = this.selectedTeam.indexOf(player);
                this.teamPlayerCounts[player.premier_league_team_id]--;

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
            this.sortSelectedTeamByPosition();
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
        // isMaxPlayersReached(teamId) {
        //     return this.teamPlayerCounts[teamId] >= 2;
        // },
        isMaxPlayersReached(teamId) {
            const maxPlayersPerTeam = 2; // Adjust this as needed
            return (
                this.teamPlayerCounts[teamId] &&
                this.teamPlayerCounts[teamId] >= maxPlayersPerTeam
            );
        },
        sortSelectedTeamByPosition() {
            this.selectedTeam.sort((a, b) => a.position - b.position);
        },
        saveTeam() {
            this.saving = true;
            axios.post('/user/team', {
                selectedPlayers: this.selectedTeam,
                teamName: this.teamName,
            })
                .then(response => {
                    this.successMessage = 'Team saved successfully';
                    console.log('Team saved successfully', response.data);
                })
                .catch(error => {
                    console.error('Error saving team', error);
                });
        },
    },
};
</script>

<style scoped>
.disabled {
    pointer-events: none;
    color: gray;
}

.fixed-column {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow: auto;
}
</style>
  