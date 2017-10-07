<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Disk Usage Overview</div>
          <div class="panel-body">
            <div class="container">
              <div class="row">
                <span class="col-md-2">Total Size:</span>
                <span>{{ diskUsageOverviews.totalSize }}MB ({{ diskUsageOverviews.fullTotalSize }}B)</span>
              </div>
              <div class="row">
                <span class="col-md-2">No of files:</span>
                <span>{{ diskUsageOverviews.noOfFile }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Disk Usage Compositions</div>
          <div class="panel-body">
            <div class="container" v-if="diskUsageCompositions.length == 0">
              <div class="row">
                <span class="col-md-2">No Data</span>
              </div>
            </div>
            <div v-else>
              <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>No of files</th>
                    <th>Size</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="diskUsageComposition in diskUsageCompositions">
                    <td>{{ diskUsageComposition.filetype }}</td>
                    <td>{{ diskUsageComposition.totalfile }}</td>
                    <td>{{ diskUsageComposition.totalsize }}MB ({{ diskUsageComposition.fullTotalsize }}B)</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      diskUsageOverviews: {
        totalSize: '',
        fullTotalSize: '',
        noOfFile: ''
      },
      diskUsageCompositions: []
    }
  },
  methods: {
    getDiskUsageOverview() {
      axios.get('api/getDiskUsageOverview?email=' + localStorage.getItem('email')).then(response => {
        this.diskUsageOverviews.totalSize = response.data.totalSize;
        this.diskUsageOverviews.fullTotalSize = response.data.fullTotalSize;
        this.diskUsageOverviews.noOfFile = response.data.noOfFile;
      });
    },
    getDiskUsageCompositions() {
      axios.get('api/diskUsageCompositions?email=' + localStorage.getItem('email')).then(response => {
        this.diskUsageCompositions = response.data;
      });
    }
  },
  created: function () {
    this.getDiskUsageOverview();
    this.getDiskUsageCompositions();
  }
}
</script>
