<template>
  <app-layout title="Community Form">
    <template #header>
      <div class="pb-5" style="background-color: #f4f4f4">
        <div class="community">
          <div class="container position-relative">
            <div class="row">
              <div class="col-md-12">
                <div
                  class="d-flex flex-column justify-content-center"
                  style="height: 280px"
                >
                  <h2 class="display-6 text-white pb-5 pb-md-0">
                    <span>{{ __("Community Forum") }}</span>
                  </h2>
                </div>
              </div>
            </div>
            <div class="post-section" v-if="$page.props.auth">
              <div
                class="card p-3 border-0 radius-20 me-3 me-md-0 position-absolute shadow-sm"
                style="background-color: #f6f6f6"
              >
                <div class="col-md-12">
                  <div class="row align-items-center px-3">
                    <div class="col-md-12 ps-md-0">
                      <div
                        class="d-flex align-items-center bg-white justify-content-between border border-1 radius-20 px-4 py-3"
                        data-bs-toggle="modal"
                        data-bs-target="#attachmentModel"
                      >
                        <input
                          type="text"
                          class="bg-transparent border-0 pe-3"
                          placeholder="Create Your Post"
                          aria-label="Create Your Post"
                          data-bs-toggle="modal"
                          data-bs-target="#attachmentModel"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container mt-5">
          <div class="row">
            <div class="col-md-8">
              <div
                class="card border-0 shadow radius-20 mb-4"
                v-for="(community_post, index) in community_posts"
                :key="index"
              >
                <div class="card-body pb-5">
                  <div class="d-flex mt-3 align-items-center gap-4">
                    <div
                      class="post-icon rounded-circle overflow-hidden border border-secondary border-2"
                      v-if="community_post.lawyer_image"
                    >
                      <img
                        :src="community_post.lawyer_image"
                        class="img-fluid"
                        :alt="community_post.lawyer_image"
                      />
                    </div>
                    <div
                      class="post-icon rounded-circle overflow-hidden border border-secondary border-2"
                      v-else
                    >
                      <img
                        src="@/images/home/user.png"
                        class="img-fluid"
                        alt="user-profile"
                      />
                    </div>

                    <div class="d-flex flex-column">
                      <h1 style="font-size: 20px" class="fw-bold text-black">
                        {{
                          community_post.lawyer_name == "" ||
                          community_post.lawyer_name == null
                            ? "John Smith"
                            : community_post.lawyer_name
                        }}
                      </h1>
                      <h6 class="fs-5 text-muted fw-normal mb-0">
                        {{ community_post.date }}
                      </h6>
                    </div>
                  </div>
                  <div>
                    <div v-if="community_post.is_shared">
                      <p
                        :class="isExpanded ? '' : 'lineclamp-5'"
                        class="fs-5 mt-4 fw-normal text-black mb-0"
                      >
                        {{ sharedform.shared_description }}
                      </p>
                      <button
                        v-if="sharedform.shared_description > 100"
                        class="bg-transparent fw-bold text-primary border-0"
                        @click="isExpanded = !isExpanded"
                      >
                        {{ isExpanded ? "See Less" : "See More" }}
                      </button>
                      <hr />
                      <div
                        class="m-3 mt-2 d-flex mt-3 align-items-center gap-4"
                      >
                        <div
                          class="post-share-icon rounded-circle overflow-hidden border border-secondary border-2"
                          v-if="community_post.lawyer_image"
                        >
                          <img
                            :src="community_post.lawyer_image"
                            class="img-fluid"
                            :alt="community_post.lawyer_image"
                          />
                        </div>
                        <div
                          class="post-icon rounded-circle overflow-hidden border border-secondary border-2"
                          v-else
                        >
                          <img
                            src="@/images/home/user.png"
                            class="img-fluid"
                            alt="user-profile"
                          />
                        </div>

                        <div class="d-flex flex-column">
                          <h1
                            style="font-size: 20px"
                            class="fw-bold text-black"
                          >
                            {{
                              community_post.share_with_name == "" ||
                              community_post.share_with_name == null
                                ? "John Smith"
                                : community_post.share_with_name
                            }}
                          </h1>
                        </div>
                      </div>
                    </div>
                    <p
                      v-html="community_post.description"
                      :class="isExpanded ? '' : 'lineclamp-5'"
                      class="fs-5 mt-4 fw-normal text-black mb-0"
                    ></p>
                    <button
                      v-if="community_post.description.length > 100"
                      class="bg-transparent fw-bold text-primary border-0"
                      @click="isExpanded = !isExpanded"
                    >
                      {{ isExpanded ? "See Less" : "See More" }}
                    </button>
                  </div>
                  <div
                    class="w-100 radius-20 post-img-container overflow-hidden mt-4"
                    v-if="community_post.image"
                  >
                    <img
                      :src="community_post.image"
                      class="img-fluid w-100 h-100"
                      alt=""
                    />
                  </div>
                  <div
                    class="w-100 radius-20 post-img-container overflow-hidden mt-4"
                    v-else-if="community_post.video"
                  >
                    <video
                      v-if="community_post.video"
                      controls
                      autoplay
                      loop
                      class="video-fluid w-100 h-100"
                    >
                      <source :src="community_post.video" type="video/mp4" />
                      Your browser does not support this video
                    </video>
                  </div>

                  <div
                    v-if="community_post.post_likes"
                    class="d-flex align-items-center gap-4 mt-4 mb-2"
                  >
                    <h6 class="fs-5 text-black fw-normal">
                      {{ community_post.post_likes }}
                      {{ community_post.post_likes === 1 ? "Like" : "Likes" }}
                    </h6>
                    <h6
                      class="fs-5 text-black fw-normal"
                      v-if="community_post.post_likes"
                    >
                      {{ community_post.post_comments.length }}
                      {{
                        community_post.post_comments.length === 1
                          ? "Comment"
                          : "Comments"
                      }}
                    </h6>
                  </div>
                  <div class="d-flex align-items-center gap-4 mt-3">
                    <button
                      @click.once="OnLike(community_post.id)"
                      class="bg-transparent text-muted border-0 fs-5 d-flex align-items-center gap-2"
                    >
                      <i class="bi bi-hand-thumbs-up text-muted fs-4"></i>
                      {{ __("Like") }}
                    </button>
                    <button
                      class="bg-transparent text-muted border-0 fs-5 d-flex align-items-center gap-2"
                    >
                      <i class="bi bi-chat fs-4"></i>
                      {{ __("Comment") }}
                    </button>
                    <button
                      v-if="$page.props.auth"
                      class="bg-transparent text-muted border-0 fs-5 d-flex align-items-center gap-2"
                      data-bs-toggle="modal"
                      data-bs-target="#shareModel"
                      @click="sharedPostData(community_post)"
                    >
                      <i class="bi bi-share fs-4"></i>
                      {{ __("Share") }}
                    </button>
                  </div>

                  <div
                    v-if="
                      community_post.post_comments &&
                      community_post.post_comments.length > 0
                    "
                    style="background-color: #fafafa"
                    class="card border-0 radius-20 mt-4"
                  >
                    <div class="card-body">
                      <div class="p-3">
                        <h4 class="fs-4 fw-medium text-black">
                          {{ __("Comments") }}
                        </h4>
                        <div
                          class="d-flex mt-3 align-items-start gap-4"
                          v-for="(
                            comment, index
                          ) in community_post.post_comments"
                          :key="comment.id"
                        >
                        <div
                          class="post-share-icon rounded-circle overflow-hidden border border-secondary border-2"
                          v-if="comment.lawyer_image"
                        >
                          <img
                            :src="comment.lawyer_image"
                            class="img-fluid"
                            :alt="comment.lawyer_image"
                          />
                        </div>
                        <div
                          class="post-icon rounded-circle overflow-hidden border border-secondary border-2"
                          v-else
                        >
                          <img
                            src="@/images/home/user.png"
                            class="img-fluid"
                            alt="user-profile"
                          />
                        </div>
                          <div class="d-flex flex-column w-100">
                            <h5 class="fw-normal fs-5 text-black mb-0">
                              {{ comment.user_name ?? comment.lawyer_name }}
                            </h5>
                            <p class="fw-normal fs-5 text-black opacity-50">
                              {{ comment.content }}
                            </p>
                            <div class="d-flex align-items-center gap-3">
                              <button
                                class="bg-transparent border-0 fs-4 text-muted"
                              >
                                <i class="bi bi-hand-thumbs-up text-muted"></i>
                              </button>
                              <button
                                @click="replyMessage(comment.id ,index)"
                                class="bg-transparent text-muted border-0 fs-4"
                              >
                                <i class="bi bi-chat"></i>
                              </button>
                            </div>
                            <input
                              v-if="is_reply_input[index]"
                              v-model="reply_comment_message[index]"
                              v-on:keyup.enter="commentReply(comment.id,index)"
                              type="text"
                              class="form-control bg-transparent border-0 pe-3"
                              placeholder="Reply..."
                            />

                            <div
                              v-if="comment.replies.length > 0"
                              class="card border-0 radius-20 mt-3"
                            >
                              <div class="card-body">
                                <div class="p-2">
                                  <h4 class="fs-4 fw-medium text-black">
                                    {{ __("Replies") }}
                                  </h4>
                                  <div
                                    class="d-flex mt-3 align-items-start gap-3"
                                    v-for="(
                                      reply_comment, index
                                    ) in comment.replies"
                                    :key="reply_comment.id"
                                  >
                                    <div
                                      class="comment-icon rounded-circle overflow-hidden border border-secondary border-2"
                                    >
                                      <img
                                        src="@/images/home/user.png"
                                        class="img-fluid"
                                        alt="user-profile"
                                      />
                                    </div>
                                    <div class="d-flex flex-column">
                                      <h5
                                        class="fw-normal fs-4 text-black mb-0"
                                      >
                                        {{
                                          reply_comment.user_name ??
                                          reply_comment.lawyer_name
                                        }}
                                      </h5>
                                      <p
                                        class="fw-normal fs-4 text-black opacity-50"
                                      >
                                        {{ reply_comment.content }}
                                      </p>
                                      <div
                                        class="d-flex align-items-center gap-3"
                                      >
                                        <button
                                          class="bg-transparent border-0 fs-4 text-muted"
                                        >
                                          <i
                                            class="bi bi-hand-thumbs-up text-muted"
                                          ></i>
                                        </button>
                                        <button
                                          class="bg-transparent text-muted border-0 fs-4"
                                        >
                                          <i class="bi bi-chat"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="d-flex  align-items-center mt-4">
                    <div
                      class="comment2-icon rounded-circle overflow-hidden border border-secondary border-2"
                      v-if="community_post.lawyer_image && $page.props.auth?.lawyer"
                    >
                      <img
                        :src="community_post.lawyer_image"
                        class="img-fluid h-100"
                        :alt="community_post.lawyer_image"
                      />
                    </div>
                    <div
                      class="comment2-icon rounded-circle overflow-hidden border border-secondary border-2"
                      v-else-if="$page.props.auth?.lawyer"
                    >
                      <img v-if="$page.props.auth?.lawyer"
                        src="@/images/home/user.png"
                        class="img-fluid h-100"
                        alt="user_image"
                      />
                    </div>
                   <div class='d-flex justify-content-center' v-else>
                    <hr/>
                    <h6 @click="loginPageRedirect" class="text-muted fw-normal text-danger fs-4">To comment, you must be logged in as a lawyer.</h6>
                   </div>
                    <div v-if="$page.props.auth?.lawyer"
                      style="background-color: #f1f1f1"
                      class="d-flex ms-3 align-items-center justify-content-between w-100 border-0 radius-20 px-4 py-3"
                    >
                      <input
                        ref="commentRef"
                        type="text"
                        v-model="commenttext[index]"
                        v-on:keyup.enter="postComment(community_post.id, index)"
                        class="bg-transparent border-0 w-100 pe-3"
                        placeholder="Type your comment here"
                        aria-label="Type your content here"
                        :disabled="!$page.props.auth?.lawyer"
                      />

                      <div class="d-flex align-items-center gap-3">
                        <button
                          class="bg-transparent comment-emoji border-0"
                          @click="commentSticker = !commentSticker"
                        >
                          <img
                            src="@/images/common/Emoji.svg"
                            width="30"
                            alt="Emoji"
                          />
                          <EmojiPicker
                            v-if="commentSticker"
                            @select="onCommentEmoji"
                          />
                        </button>
                        <button
                          :disabled="!$page.props.auth?.lawyer"
                          class="bg-transparent border-0"
                          data-bs-toggle="modal"
                          data-bs-target="#commentModel"
                        >
                          <img
                            src="@/images/common/attach-2.svg"
                            width="18"
                            alt="Attach"
                          />
                        </button>
                        <div
                          class="modal fade"
                          id="commentModel"
                          tabindex="-1"
                          aria-labelledby="commentModelLabel"
                          aria-hidden="true"
                        >
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5
                                  class="modal-title"
                                  id="attachmentModelLabel"
                                >
                                  {{ __("Upload Attachments") }}
                                </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                <div class="d-flex flex-column">
                                  <label
                                    for="file-upload"
                                    class="btn btn-secondary rounded-4 fw-bold"
                                  >
                                    <i class="bi bi-paperclip text-white"></i>
                                    Choose File
                                  </label>

                                  <input
                                    id="file-upload"
                                    type="file"
                                    style="display: none"
                                  />
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button
                                  type="button"
                                  class="btn btn-secondary"
                                  data-bs-dismiss="modal"
                                >
                                  {{ __("close") }}
                                </button>
                                <button type="button" class="btn btn-primary">
                                  {{ __("submit") }}
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button
                          class="bg-transparent border-0"
                          @click="postComment(community_post.id, index)"
                        >
                          <img
                            src="@/images/common/send.svg"
                            width="30"
                            alt="send"
                          />
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card p-2 border-0 radius-20 shadow mb-4">
                <div class="card-body">
                  <h1 style="font-size: 20px" class="fw-bold text-black mt-2">
                    {{ __("Upcoming Events") }}
                  </h1>
                  <div
                    class="d-flex align-items-center mt-4 mb-3"
                    v-for="event in events"
                    :key="event.id"
                  >
                    <div
                      class="overflow-hidden rounded-4"
                      style="width: 134px; height: 80px"
                    >
                      <img
                        src="@/images/home/members-icon.png"
                        class="img-fluid h-100 w-100"
                        alt=""
                      />
                    </div>
                    <div
                      class="d-flex align-items-start flex-column ms-md-3 ms-3"
                    >
                      <h1 class="text-black fs-5 fw-medium">
                        {{ event.name }}
                      </h1>
                      <Link
                        :href="`events/${event.slug}`"
                        class="text-primary text-decoration-none fs-5 fw-medium"
                        >{{ __("View Details") }}</Link
                      >
                    </div>
                  </div>
                </div>
              </div>
              <div class="card p-2 border-0 radius-20 shadow mb-4">
                <div class="card-body">
                  <h1
                    style="font-size: 20px"
                    class="fw-bold text-black mt-2 mb-4"
                  >
                    {{ __("FAQs on legal discussion") }}
                  </h1>
                  <div
                    class="d-flex align-items-start mb-3 gap-3"
                    v-for="(faq, index) in faqs"
                    :key="faq.id"
                  >
                    <h1
                      style="font-size: 20px"
                      class="fw-bold text-primary mb-0 mt-1"
                    >
                      Q:{{ index + 1 }}
                    </h1>

                    <Link style="color: inherit" class="mb-0"
                      ><p style="color: #9e9898" class="fs-5 fw-normal mb-0">
                        {{ faq.name }}
                      </p></Link
                    >
                  </div>
                </div>
              </div>
              <div class="card p-2 border-0 radius-20 shadow mb-4">
                <div class="card-body">
                  <h1
                    style="font-size: 20px"
                    class="fw-bold text-black mt-2 mb-4"
                  >
                    {{ __("Trending Posts") }}
                  </h1>
                  <div
                    class="row align-items-center mb-3"
                    v-for="trending_post in trending_posts.slice(0, 5)"
                    :key="trending_post.id"
                  >
                    <div class="col-4">
                      <div
                        class="overflow-hidden rounded-4"
                        style="width: 100px; height: 80px"
                        v-if="trending_post.image"
                      >
                        <img
                          :src="trending_post.image"
                          class="img-fluid h-100 w-100"
                          :alt="trending_post.image"
                        />
                      </div>
                      <div
                        class="overflow-hidden rounded-4"
                        style="width: 100px; height: 80px"
                        v-else
                      >
                        <img
                          src="@/images/home/members-icon.png"
                          class="img-fluid h-100 w-100"
                          alt=""
                        />
                      </div>
                    </div>
                    <div class="col-8">
                      <h1
                        class="text-black fs-6 fw-medium lineclamp-2"
                        v-html="trending_post.description"
                      ></h1>
                      <Link
                    :href="trending_post.slug ? route('community_post.detail', { slug: trending_post.slug }) : '#'"
                    class="text-primary text-decoration-none fs-6 fw-medium"
                    :class="{ 'disabled-link': !trending_post.slug }"
                    >
                    {{ trending_post.slug ? __("View Details") : __("Unavailable") }}
                    </Link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Share Model Component -->
      <div
        class="modal fade"
        id="shareModel"
        tabindex="-1"
        aria-labelledby="shareModelLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content p-md-2">
            <div class="modal-header border-0">
              <div class="d-flex align-items-center gap-3">
                <div
                  class="create-post-icon rounded-circle overflow-hidden"
                  v-if="$page.props.auth?.lawyer?.image"
                >
                  <img
                    :src="$page.props.auth?.lawyer?.image"
                    class="img-fluid w-100"
                    alt=""
                  />
                </div>
                <div
                  class="create-post-icon rounded-circle overflow-hidden"
                  v-else
                >
                  <img
                    src="@/images/home/user.png"
                    class="img-fluid w-100"
                    alt=""
                  />
                </div>
                <h2
                  class="fs-2 text-black mb-0 fw-medium"
                  v-if="$page.props.auth"
                >
                  {{ $page.props.auth.user.name }}
                </h2>
              </div>
              <!-- <h5 class="modal-title" id="attachmentModelLabel">
                {{ __("Create Post") }}
              </h5> -->
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>

            <div class="modal-body">
              <validation-errors class="mb-3" />
              <div class="d-flex flex-column">
                <!-- <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Post Title</label
                  >
                  <input
                    type="text"
                    v-model="form.name"
                    class="form-control"
                    id="postitle"
                    placeholder="Post Title"
                  />
                </div> -->
                <div class="mb-3">
                  <textarea
                    ref="inputRef"
                    class="form-control text-area border-0"
                    v-model="sharedform.shared_description"
                    id="exampleFormControlTextarea1"
                    placeholder="What do you want to talk about?"
                    rows="5"
                  ></textarea>
                </div>
                <div class="mb-3">
                  <p class="fs-3 text-black">
                    {{ sharedform.sharedtext }}
                  </p>
                </div>
                <div class="d-flex align-items-center gap-1">
                  <div class="d-flex flex-column position-relative">
                    <button
                      class="emoji-button border-0"
                      @click="isOpen = !isOpen"
                    >
                      <img
                        src="@/images/common/Emoji.svg"
                        width="30"
                        alt="Emoji"
                      />
                    </button>
                    <EmojiPicker v-if="isOpen" @select="onSelectEmoji" />
                  </div>
                </div>
                <!-- <label for="file-upload" class="custom-file-upload">
                  <i class="bi bi-paperclip text-white"></i>
                  Choose File
                </label> -->

                <!-- <ImageCropperModal
                  :show="showImportModal"
                  id="imageCropModal"
                  :image_url="image_url"
                  @cropImage="cropImage"
                >
                </ImageCropperModal> -->
                <div
                  v-if="sharedform.sharedImg"
                  class="rounded-4 overflow-hidden w-100 mt-3"
                  style="height: 300px"
                >
                  <img :src="sharedform.sharedImg" class="w-100 h-100" />
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                ref="CloseShare"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                {{ __("close") }}
              </button>
              <button type="button" @click="sharedPost" class="btn btn-primary">
                {{ __("Share") }}
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Share Model Component -->
      <!-- Modal Component -->
      <div
        class="modal fade"
        id="attachmentModel"
        tabindex="-1"
        aria-labelledby="attachmentModelLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content p-md-2">
            <div class="modal-header border-0">
              <div class="d-flex align-items-center gap-3">
                <div
                  class="create-post-icon rounded-circle overflow-hidden"
                  v-if="$page.props.auth?.lawyer?.image"
                >
                  <img
                    :src="$page.props.auth?.lawyer?.image"
                    class="img-fluid w-100"
                    alt=""
                  />
                </div>
                <div
                  class="create-post-icon rounded-circle overflow-hidden"
                  v-else
                >
                  <img
                    src="@/images/home/user.png"
                    class="img-fluid w-100"
                    alt=""
                  />
                </div>
                <h2
                  class="fs-2 text-black mb-0 fw-medium"
                  v-if="$page.props.auth"
                >
                  {{ $page.props.auth.user.name }}
                </h2>
              </div>
              <!-- <h5 class="modal-title" id="attachmentModelLabel">
                {{ __("Create Post") }}
              </h5> -->
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>

            <div class="modal-body">
              <validation-errors class="mb-3" />
              <div class="d-flex flex-column">
                <!-- <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label"
                    >Post Title</label
                  >
                  <input
                    type="text"
                    v-model="form.name"
                    class="form-control"
                    id="postitle"
                    placeholder="Post Title"
                  />
                </div> -->
                <div class="mb-3">
                  <textarea
                    ref="inputRef"
                    class="form-control text-area border-0"
                    v-model="form.description"
                    id="exampleFormControlTextarea1"
                    placeholder="What do you want to talk about?"
                    rows="5"
                  ></textarea>
                </div>
                <div class="d-flex align-items-center gap-1">
                  <div class="d-flex flex-column position-relative">
                    <button
                      class="emoji-button border-0"
                      @click="isOpen = !isOpen"
                    >
                      <img
                        src="@/images/common/Emoji.svg"
                        width="30"
                        alt="Emoji"
                      />
                    </button>
                    <EmojiPicker v-if="isOpen" @select="onSelectEmoji" />
                  </div>
                  <label for="attachment_file" class="emoji-button border-0">
                    <img
                      src="@/images/common/attach-2.svg"
                      width="20"
                      alt="Emoji"
                    />
                  </label>
                  <input
                    type="file"
                    id="attachment_file"
                    style="display: none"
                    name="attachment_file"
                    ref="attachment_file"
                    @change="processFile($event)"
                  />
                </div>
                <!-- <label for="file-upload" class="custom-file-upload">
                  <i class="bi bi-paperclip text-white"></i>
                  Choose File
                </label> -->

                <!-- <ImageCropperModal
                  :show="showImportModal"
                  id="imageCropModal"
                  :image_url="image_url"
                  @cropImage="cropImage"
                >
                </ImageCropperModal> -->
                <div
                v-if="attachment_view"
                class="rounded-4 overflow-hidden w-100 mt-3"
                style="height: 300px"
                >
                <img
                    v-if="form.attachment && form.attachment.type && form.attachment.type.includes('image')"
                    :src="attachment_view"
                    class="img-fluid w-100 h-100"
                    alt="Post preview"
                />
                <video
                    v-else-if="form.attachment && form.attachment.type && form.attachment.type.includes('video')"
                    :src="attachment_view"
                    class="img-fluid w-100 h-100"
                    controls
                ></video>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button
                ref="Close"
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                {{ __("close") }}
              </button>
              <button type="button" @click="submitPost" class="btn btn-primary">
                {{ __("post") }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </template>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import PageHeader from "@/Components/PageHeader.vue";
import { Link } from "@inertiajs/inertia-vue3";
import ValidationErrors from "@/Components/ValidationErrors.vue";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";
import EmojiPicker from "vue3-emoji-picker";
import "vue3-emoji-picker/css";
import axios from "axios";
import { Inertia } from "@inertiajs/inertia";
// import ImageCropperModal from "@/Components//Shared/ImageCropperModal.vue";

export default defineComponent({
  components: {
    AppLayout,
    PageHeader,
    ValidationErrors,
    Link,
    Modal,
    EmojiPicker,
  },
  data() {
    return {
      isExpanded: false,
      //   replyMessage: "",
      attachment_view: "",
      sharedform: this.$inertia.form({
        sharedImg: "",
        sharedtext: "",
        shared_description: "",
        is_shared: 1,
      }),
      form: this.$inertia.form({
        name: "",
        description: "",
        attachment: "",
        is_community_post: 1,
      }),
      text: "",

      commenttext: [],
      isOpen: false,
      community_posts: [],
      faqs: [],
      trending_posts: [],
      events: [],
      liked: false,
      is_reply_input: [],
      reply_comment_message: [],
    };
  },
  created() {
    this.getCommunityPosts(false);

    this.getFAQs();
    this.getTrendingCommunityPosts();
    this.getEvents();
  },
  methods: {
    sharedPostData(postData) {
      this.sharedform.sharedtext = postData.description;
      this.sharedform.sharedImg = postData.image;
    },
    replyMessage(comment_id ,index) {
      console.log(comment_id);

      this.is_reply_input[index] = this.is_reply_input[index]==true ? false : true;
    },
    submitPost() {
      this.form.post(this.route("lawyers.community_posts.store"), {
        onSuccess: (resp) => {
          const newPost = {
            lawyer_name: this.$page.props.auth.user.name,
            name: this.form.name,
            description: this.form.description,
            attachment: this.attachment_view,
            is_community_post: this.form.is_community_post,
            date: "Now",
          };

          this.community_posts.unshift(newPost);
          this.form.reset();

          this.$refs.Close.click();
          this.getCommunityPosts();
        },
      });
    },
    sharedPost() {
      this.sharedform.post(this.route("lawyers.community_posts.store"), {
        onSuccess: (resp) => {
          this.$refs.CloseShare.click();
          this.getCommunityPosts();
        },
      });
    },
    onCommentEmoji(emoji) {
      const input = this.$refs.commentRef;
      const currentCursorPosition = input.selectionStart;
      const currentValue = input.value;
      const newValue =
        currentValue.slice(0, currentCursorPosition) +
        emoji.i +
        currentValue.slice(currentCursorPosition);

      this.commenttext = newValue;

      input.focus();
    },
    loginPageRedirect(){
        Inertia.visit("/login");
    },
    onSelectEmoji(emoji) {
      const input = this.$refs.inputRef;
      const currentCursorPosition = input.selectionStart;
      const currentValue = input.value;

      const newValue =
        currentValue.slice(0, currentCursorPosition) +
        emoji.i +
        currentValue.slice(currentCursorPosition);

      this.form.description = newValue;

      input.focus();

      setTimeout(() => {
        const newCursorPosition = currentCursorPosition + emoji.i.length;
        input.setSelectionRange(newCursorPosition, newCursorPosition);
      }, 0);
    },
    getCommunityPosts() {
      axios.get(this.route("lawyers.community_posts.index")).then((res) => {
        this.community_posts = res.data.data;
      });
    },
    getFAQs() {
      axios.get(this.route("getApiFaqs")).then((res) => {
        this.faqs = res.data.data;
      });
    },
    getTrendingCommunityPosts() {
      axios.get(this.route("getApiTrendingCommunityPosts")).then((res) => {
        this.trending_posts = res.data.data;
      });
    },
    getEvents() {
      axios.get(this.route("getApiFeaturedEvents")).then((res) => {
        this.events = res.data.data;
      });
    },
    async OnLike(postId) {
      try {
        const response = await axios.post(`/community_post_like/${postId}`);
        if (response.data.success) {
          const post = this.community_posts.find((post) => post.id === postId);
          if (post) {
            if (this.liked) {
              post.post_likes--;
            } else {
              post.post_likes++;
            }
            this.liked = !this.liked;
          }
        }
      } catch (error) {
        console.error("Error liking the post:", error);
        if (error.response && error.response.status === 401) {
          Inertia.visit("/login");
        }
      }
    },
    async postComment(postId, index) {
      if (!this.commenttext[index]) {
        console.warn("Comment text is empty or null. Aborting submission.");
        return;
      }
      try {
        const response = await axios.post(`/community_post_comment/${postId}`, {
          comment: this.commenttext[index],
        });
        if (response.data.success) {
          const post = this.community_posts.find((post) => post.id === postId);
          if (post) {
            post.post_comments.push({
              user_name: this.$page.props.auth.user.name,
              content: this.commenttext[index],
              replies: [],
            });
          }
          this.commenttext[index] = "";
          console.log("user_id", this.$page.props.auth.user.id);
          this.getCommunityPosts();
        }
      } catch (error) {
        console.error("Error submitting the comment:", error);
        if (error.response && error.response.status === 401) {
          Inertia.visit("/login");
        }
      }
    },
    processFile(event) {
      this.form.attachment = event.target.files[0];
      const fileType = event.target.files[0].type;

      if (fileType.includes("image")) {
        // If the file is an image, generate an image preview
        this.attachment_view = URL.createObjectURL(event.target.files[0]);
      } else if (fileType.includes("video")) {
        // If the file is a video, generate a video preview
        this.attachment_view = URL.createObjectURL(event.target.files[0]);
      } else {
        // If the file is neither image nor video, reset the preview
        this.attachment_view = "";
      }
    },
    async commentReply(comment_id,index) {


      try {
        const response = await axios.post(
          `/community_post_comment_reply/${comment_id}`,
          {
            content: this.reply_comment_message[index],
          }
        );
        if (response.data.success) {
          //   const post = this.community_posts.find((post) => post.id === postId);
          //   if (post) {
          //     post.post_comments.push({
          //       user_name: this.$page.props.auth.user.name,
          //       content: this.commenttext[index],
          //     });
          //   }
          //   this.commenttext[index] = "";
          //   console.log("user_id", this.$page.props.auth.user.id);

          this.reply_comment_message[index] = "";
          this.is_reply_input[index] = true;
          this.getCommunityPosts();
        }
      } catch (error) {
        console.error("Error submitting the comment:", error);
      }
    },
  },
});
</script>


<style >
.lineclamp-5 {
  overflow: hidden;
  display: -webkit-box;
  -webkit-line-clamp: 5;
  line-clamp: 5;
  -webkit-box-orient: vertical;
}
</style>
